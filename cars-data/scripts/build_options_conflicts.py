"""
Build options_conflicts.js for rental/car.php option mutex detection.

Reads:
  cars-data/source/*.json  (raw scrape data, primary source — includes sub-items)
  car_brands.js            (per-trim option_packages strings, secondary coverage)

Writes: cars-data/options_conflicts.js

Detection rules:
  1) Wheel/tire mutex      — options containing tire size (245/45R19) or "XX인치 + 휠/타이어/알로이/림"
  2) Display slot mutex    — options containing "XX인치 + 디스플레이/내비/오디오/모니터/AVN/클러스터"
  3) Tier suffix variants  — same base name + Roman/I-V suffix (시그니쳐 셀렉션Ⅰ vs Ⅱ)
  4) Sub-item inclusion    — option A's sub-item name matches option B's name → A ⊃ B (e.g., 파퓰러 패키지 ⊃ 빌트인캠)
  5) Same-name duplicate   — same option name appears twice in one trim → marked __SAME_NAME__

Output: {modelId: {optionBareName: [conflictBareName, ...]}}
"""
import json
import os
import re
import glob
from collections import defaultdict

HERE = os.path.dirname(os.path.abspath(__file__))
SRC_DIR = os.path.abspath(os.path.join(HERE, '..', 'source'))
CAR_BRANDS_PATH = os.path.abspath(os.path.join(HERE, '..', '..', 'car_brands.js'))
OUT = os.path.abspath(os.path.join(HERE, '..', 'options_conflicts.js'))

TIRE_RE = re.compile(r'\d{3}/\d{2,3}R\d{2}')
WHEEL_KW_RE = re.compile(r'\d{1,2}\s*인치.*?(휠|타이어|알로이|림)')
DISPLAY_RE = re.compile(r'\d{1,2}\s*인치.*?(디스플레이|내비|오디오|모니터|AVN|클러스터)', re.IGNORECASE)
TIER_SUFFIX_RE = re.compile(r'\s*[\sⅠⅡⅢⅣⅤⅥⅦIVX]+\s*$')
PRICE_SUFFIX_RE = re.compile(r'\s*\(\s*[\d,]+\s*만원\s*\)\s*$')


def is_wheel_option(name):
    return bool(TIRE_RE.search(name) or WHEEL_KW_RE.search(name))


def is_display_option(name):
    return bool(DISPLAY_RE.search(name))


def tier_base(name):
    return TIER_SUFFIX_RE.sub('', name).strip()


def has_tier_suffix(name):
    b = tier_base(name)
    return b != name and len(b) >= 3


def strip_price(label):
    return PRICE_SUFFIX_RE.sub('', label).strip()


def add_mutex_group(conflicts, names):
    uniq = list(set(names))
    if len(uniq) > 1:
        for a in uniq:
            for b in uniq:
                if a != b:
                    conflicts[a].add(b)


def detect_within_trim(opts_with_items):
    conflicts = defaultdict(set)
    names = [o['name'] for o in opts_with_items]

    add_mutex_group(conflicts, [n for n in names if is_wheel_option(n)])
    add_mutex_group(conflicts, [n for n in names if is_display_option(n)])

    names_set = set(names)
    for o in opts_with_items:
        for it in o.get('items', []):
            iname = (it.get('name') or '').strip()
            if iname and iname in names_set and iname != o['name']:
                conflicts[o['name']].add(iname)
                conflicts[iname].add(o['name'])

    name_counts = defaultdict(int)
    for n in names:
        name_counts[n] += 1
    for name, c in name_counts.items():
        if c > 1:
            conflicts[name].add('__SAME_NAME__')

    tiered = defaultdict(list)
    for n in names:
        if has_tier_suffix(n):
            tiered[tier_base(n)].append(n)
    for _base, group in tiered.items():
        add_mutex_group(conflicts, group)

    return conflicts


def detect_from_names(names):
    conflicts = defaultdict(set)
    add_mutex_group(conflicts, [n for n in names if is_wheel_option(n)])
    add_mutex_group(conflicts, [n for n in names if is_display_option(n)])

    tiered = defaultdict(list)
    for n in names:
        if has_tier_suffix(n):
            tiered[tier_base(n)].append(n)
    for _base, group in tiered.items():
        add_mutex_group(conflicts, group)

    name_counts = defaultdict(int)
    for n in names:
        name_counts[n] += 1
    for name, c in name_counts.items():
        if c > 1:
            conflicts[name].add('__SAME_NAME__')
    return conflicts


def main():
    result = defaultdict(lambda: defaultdict(set))

    # Pass A: rich webapp source data
    files = glob.glob(os.path.join(SRC_DIR, '*.json'))
    for f in files:
        with open(f, 'r', encoding='utf-8') as fh:
            d = json.load(fh)
        mid = str(d.get('model_id'))
        for lu in d.get('lineups', []):
            for tr in lu.get('trims', []):
                opts = tr.get('options', [])
                if not opts:
                    continue
                c = detect_within_trim(opts)
                for k, vset in c.items():
                    result[mid][k] |= vset

    # Pass B: car_brands.js per-trim option_packages (broader coverage)
    with open(CAR_BRANDS_PATH, 'r', encoding='utf-8') as f:
        content = f.read()
    m = re.search(r'window\.CAR_BRANDS_DATA\s*=\s*(\{.*\})\s*;?\s*$', content, re.S)
    data = json.loads(m.group(1))

    for brand in data['brands']:
        for v in brand.get('vehicles', []):
            url = v.get('image_url', '')
            midm = re.search(r'photo/(\d+)/', url)
            if not midm:
                continue
            mid = midm.group(1)
            for t in v.get('trims', []):
                labels = t.get('option_packages', [])
                if not labels:
                    continue
                names = [strip_price(L) for L in labels]
                c = detect_from_names(names)
                for k, vset in c.items():
                    result[mid][k] |= vset

    final = {mid: {k: sorted(v) for k, v in opts.items()} for mid, opts in result.items() if opts}

    with open(OUT, 'w', encoding='utf-8') as fo:
        fo.write('window.CAR_OPTIONS_CONFLICTS = ')
        json.dump(final, fo, ensure_ascii=False, separators=(',', ':'))
        fo.write(';\n')

    total_pairs = sum(len(v) for m in final.values() for v in m.values())
    print(f'Wrote {OUT}')
    print(f'  Size: {os.path.getsize(OUT)/1024:.1f} KB')
    print(f'  Models: {len(final)}')
    print(f'  Option keys: {sum(len(m) for m in final.values())}')
    print(f'  Conflict entries: {total_pairs}')


if __name__ == '__main__':
    main()

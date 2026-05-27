"""
Build options_data.js for rental/car.php option detail tooltips.

Reads:  cars-data/source/*.json  (raw per-model data scraped from danawa)
Writes: cars-data/options_data.js

Structure: window.CAR_OPTIONS_DATA = {modelId: {optionName: [{n, e?, i?}]}}
  n = item name, e = description (optional), i = image path (optional, relative to danawa CDN)
"""
import json
import os
import glob

HERE = os.path.dirname(os.path.abspath(__file__))
SRC_DIR = os.path.abspath(os.path.join(HERE, '..', 'source'))
OUT = os.path.abspath(os.path.join(HERE, '..', 'options_data.js'))
DANAWA_PREFIX = 'https://autoimg.danawa.com/photo/'


def _normalize_img(img):
    if not img:
        return ''
    img = img.strip()
    if img.startswith(DANAWA_PREFIX):
        return img[len(DANAWA_PREFIX):]
    return img


def main():
    files = glob.glob(os.path.join(SRC_DIR, '*.json'))

    # Pass 1: build global image-by-item-name fallback map.
    # Same item name (e.g., "증강현실 내비게이션") may have an image in some models
    # but be missing it in others due to scrape inconsistency. Use any available
    # image as fallback for the same-named item across all models.
    global_img = {}
    global_exp = {}
    for f in files:
        with open(f, 'r', encoding='utf-8') as fh:
            d = json.load(fh)
        for lu in d.get('lineups', []):
            for tr in lu.get('trims', []):
                for op in tr.get('options', []):
                    for it in op.get('items', []):
                        name = (it.get('name') or '').strip()
                        if not name:
                            continue
                        img = _normalize_img(it.get('image') or '')
                        if img and name not in global_img:
                            global_img[name] = img
                        exp = (it.get('exp') or '').strip()
                        if exp and name not in global_exp:
                            global_exp[name] = exp

    # Pass 2: build per-model data, falling back to global maps where source is empty.
    result = {}
    backfilled_img = 0
    backfilled_exp = 0
    for f in files:
        with open(f, 'r', encoding='utf-8') as fh:
            d = json.load(fh)
        mid = str(d.get('model_id'))
        bucket = {}
        for lu in d.get('lineups', []):
            for tr in lu.get('trims', []):
                for op in tr.get('options', []):
                    items = op.get('items', [])
                    if not items:
                        continue
                    name = (op.get('name') or '').strip()
                    if not name or name in bucket:
                        continue
                    clean_items = []
                    for it in items:
                        item_name = (it.get('name') or '').strip()
                        item_obj = {'n': item_name}
                        exp = (it.get('exp') or '').strip()
                        img = _normalize_img(it.get('image') or '')
                        if not exp and item_name in global_exp:
                            exp = global_exp[item_name]
                            backfilled_exp += 1
                        if not img and item_name in global_img:
                            img = global_img[item_name]
                            backfilled_img += 1
                        if exp:
                            item_obj['e'] = exp
                        if img:
                            item_obj['i'] = img
                        clean_items.append(item_obj)
                    if clean_items:
                        bucket[name] = clean_items
        if bucket:
            result[mid] = bucket

    with open(OUT, 'w', encoding='utf-8') as fo:
        fo.write('window.CAR_OPTIONS_DATA = ')
        json.dump(result, fo, ensure_ascii=False, separators=(',', ':'))
        fo.write(';\nwindow.CAR_OPTIONS_IMG_PREFIX = ' + json.dumps(DANAWA_PREFIX) + ';\n')

    size = os.path.getsize(OUT)
    print(f'Wrote {OUT}')
    print(f'  Size: {size:,} bytes ({size/1024:.1f} KB)')
    print(f'  Models with options: {len(result)}')
    print(f'  Image backfills: {backfilled_img}')
    print(f'  Description backfills: {backfilled_exp}')


if __name__ == '__main__':
    main()

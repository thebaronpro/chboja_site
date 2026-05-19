import json, os

data_dir = 'C:/Users/user/cars data/webapp/data'
cars_dir = 'C:/Users/user/chaboza site/cars'

local = {}
for fn in os.listdir(cars_dir):
    parts = fn.replace('.png','').split('_')
    if len(parts)==2 and parts[1].isdigit():
        local[parts[1]] = fn

brands = {}
for fn in sorted(os.listdir(data_dir)):
    if not fn.endswith('.json'): continue
    model_id = fn.replace('.json','')
    with open(os.path.join(data_dir, fn), encoding='utf-8') as f:
        d = json.load(f)
    brand = d.get('brand',''); name = d.get('name','')
    if not brand or not name: continue
    local_file = local.get(model_id)
    img = '../cars/' + (local_file if local_file else f'cdn_{model_id}.png')
    if brand not in brands: brands[brand] = []
    brands[brand].append({'n': name, 'i': img})

domestic = ['현대','기아','제네시스','KG모빌리티','르노코리아','쉐보레']
imports_list = sorted([b for b in brands if b not in domestic])

js_data = 'const DOMESTIC_BRANDS=' + json.dumps(domestic, ensure_ascii=False) + ';\n'
js_data += 'const IMPORT_BRANDS=' + json.dumps(imports_list, ensure_ascii=False) + ';\n'
js_data += 'const ALL_BRAND_CARS=' + json.dumps(brands, ensure_ascii=False) + ';\n'

with open('C:/Users/user/chaboza site/rental/search_data.js', 'w', encoding='utf-8') as f:
    f.write(js_data)
print('OK', len(brands), 'brands')

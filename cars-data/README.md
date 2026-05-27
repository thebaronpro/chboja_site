# cars-data

차량 옵션 상세·충돌 데이터 (다나와 출처).

## 폴더 구조

```
cars-data/
  source/              # 원본 per-model JSON (다나와에서 스크랩한 raw 데이터, 110MB)
  scripts/             # 데이터 재생성 스크립트
  options_data.js      # 옵션 항목 상세 (rental/car.php에서 사용)
  options_conflicts.js # 옵션 충돌 맵 (rental/car.php에서 사용)
```

## 사이트가 실제로 로드하는 파일

- `cars-data/options_data.js` — 옵션 `?` 버튼 클릭 시 표시되는 항목 리스트(이름·설명·이미지)
- `cars-data/options_conflicts.js` — 충돌 옵션 자동 해제 확인 다이얼로그용

이 두 파일과 프로젝트 루트의 `car_brands.js`만 있으면 사이트 동작 가능.
`source/`는 재생성 시에만 필요.

## 데이터 재생성

원본 데이터를 갱신하거나 충돌 룰을 수정한 후 재빌드:

```powershell
cd "C:\Users\user\chaboza site\cars-data\scripts"
python build_options_data.py
python build_options_conflicts.py
```

스크립트는 `source/*.json`을 읽어 `cars-data/` 루트에 `.js` 파일을 출력합니다.

## 충돌 감지 규칙

`build_options_conflicts.py`에서 다음 패턴 자동 탐지:

1. **휠/타이어 mutex** — `\d{3}/\d{2,3}R\d{2}` 또는 `XX인치 + (휠|타이어|알로이|림)`
2. **디스플레이 슬롯 mutex** — `XX인치 + (디스플레이|내비|오디오|모니터|AVN|클러스터)`
3. **등급 변형** — 같은 베이스명 + Ⅰ/Ⅱ/Ⅲ 같은 로마숫자 suffix
4. **하위 항목 포함** — A의 sub-item 이름이 B의 옵션명과 동일 → A ⊃ B
5. **같은 이름 중복** — 한 트림에 같은 이름 옵션이 두 번 등장 → `__SAME_NAME__` 처리

## 출처

`source/` JSON들은 [다나와 자동차](https://auto.danawa.com) 트림별 옵션 API에서 추출한 데이터.
필드 구조:
```
{
  model_id, brand, name, img,
  lineups: [{
    lineupNo, name, year,
    trims: [{
      trimNo, trimName, price,
      options: [{
        seq, name, price, code,
        items: [{ name, exp, image }]
      }]
    }]
  }]
}
```

<?php
/**
 * 수집 현황 대시보드 (웹 UI).
 *
 * 브라우저에서:
 *   http://localhost:8000/quote-engine/status.php
 */

$base = __DIR__;
$collected = json_decode(file_get_contents("$base/sample_data/kb_collected.json"), true);
$priority_raw = file_get_contents("$base/config/priority_vehicles.yaml");

// YAML 파서 없으면 단순 파싱
function parse_priority($raw) {
    $vehicles = [];
    $cur = null;
    foreach (explode("\n", $raw) as $line) {
        if (preg_match("/^\s+- \{(.+)\}/", $line, $m)) {
            $obj = [];
            foreach (explode(',', $m[1]) as $kv) {
                if (preg_match("/(\w+):\s*(.+)/", trim($kv), $kvm)) {
                    $v = trim($kvm[2], " '\"");
                    $obj[$kvm[1]] = $v;
                }
            }
            $vehicles[] = $obj;
        }
    }
    return $vehicles;
}
$vehicles = parse_priority($priority_raw);

$trims = $collected['trims'] ?? [];
$by_completeness = ['full'=>0, 'partial'=>0, 'mapping_only'=>0];
$by_category = [];
$total_quotes = 0;
foreach ($trims as $t) {
    $c = $t['completeness'] ?? 'partial';
    $by_completeness[$c] = ($by_completeness[$c] ?? 0) + 1;
    $by_category[$t['category'] ?? '?'] = ($by_category[$t['category'] ?? '?'] ?? 0) + 1;
    $total_quotes += count($t['base_quotes'] ?? []);
}

$by_status = [];
foreach ($vehicles as $v) {
    $s = $v['status'] ?? 'pending';
    $by_status[$s] = ($by_status[$s] ?? 0) + 1;
}

// 다음 추천 (P0~P4 + pending 우선)
$next = array_filter($vehicles, fn($v) => in_array($v['status'] ?? 'pending', ['pending','partial']));
usort($next, fn($a,$b) => strcmp($a['priority'] ?? 'P9', $b['priority'] ?? 'P9'));
?><!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>KB 수집 현황 — 차보자</title>
<style>
body{font-family:-apple-system,'Pretendard Variable',sans-serif;background:#fafafa;color:#0a0a0a;padding:1.5rem;max-width:880px;margin:0 auto}
h1{font-size:1.4rem;font-weight:900;margin-bottom:.3rem}
h1 small{font-size:.7rem;color:#737373;font-weight:600;margin-left:.5rem}
.card{background:#fff;border:1px solid #e5e5e5;border-radius:12px;padding:1rem 1.25rem;margin-bottom:1rem}
.card h3{font-size:.85rem;font-weight:800;color:#525252;margin-bottom:.7rem;letter-spacing:-.01em}
.kpi{display:grid;grid-template-columns:repeat(4,1fr);gap:.7rem}
.kpi-item{background:#f5f9ff;border-radius:10px;padding:.85rem .9rem}
.kpi-item .val{font-size:1.5rem;font-weight:900;color:#1E4FCC;line-height:1}
.kpi-item .lbl{font-size:.7rem;color:#737373;margin-top:.2rem;font-weight:600}
table{width:100%;border-collapse:collapse;font-size:.82rem}
th{text-align:left;background:#fafafa;padding:.5rem .65rem;font-weight:700;color:#525252;font-size:.75rem;border-bottom:1px solid #e5e5e5}
td{padding:.5rem .65rem;border-bottom:1px solid #f5f5f5}
.badge{display:inline-block;font-size:.65rem;padding:.13rem .45rem;border-radius:4px;font-weight:700}
.b-full{background:#dcfce7;color:#15803d}
.b-partial{background:#fef3c7;color:#a16207}
.b-mapping{background:#e5e5e5;color:#525252}
.b-pending{background:#fee2e2;color:#991b1b}
.b-matrix-done{background:#dbeafe;color:#1e40af}
.cmd{background:#f5f5f5;padding:.6rem .85rem;border-radius:6px;font-family:Consolas,monospace;font-size:.78rem;color:#0a0a0a;margin:.4rem 0;overflow-x:auto}
.priority-row td:first-child{font-weight:700}
</style>
</head>
<body>
<h1>KB 수집 현황 <small>마지막 업데이트 <?= htmlspecialchars($collected['_metadata']['last_updated'] ?? '?') ?></small></h1>

<div class="card">
  <h3>핵심 지표</h3>
  <div class="kpi">
    <div class="kpi-item">
      <div class="val"><?= count($trims) ?></div>
      <div class="lbl">수집 트림</div>
    </div>
    <div class="kpi-item">
      <div class="val"><?= $total_quotes ?></div>
      <div class="lbl">총 견적 데이터</div>
    </div>
    <div class="kpi-item">
      <div class="val"><?= $by_completeness['full'] ?? 0 ?></div>
      <div class="lbl">완전 측정 (25/25)</div>
    </div>
    <div class="kpi-item">
      <div class="val"><?= $by_completeness['partial'] ?? 0 ?></div>
      <div class="lbl">부분 측정</div>
    </div>
  </div>
</div>

<div class="card">
  <h3>카테고리 분포</h3>
  <table>
    <thead><tr><th>카테고리</th><th>트림 수</th></tr></thead>
    <tbody>
      <?php foreach ($by_category as $cat => $cnt): ?>
        <tr><td><?= htmlspecialchars($cat) ?></td><td><?= $cnt ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="card">
  <h3>우선순위 차량 진행도 (전체 <?= count($vehicles) ?>대)</h3>
  <table>
    <thead><tr><th>상태</th><th>차량 수</th></tr></thead>
    <tbody>
      <?php foreach ($by_status as $st => $cnt): ?>
        <tr><td><span class="badge b-<?= str_replace('_','-',$st) ?>"><?= htmlspecialchars($st) ?></span></td><td><?= $cnt ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="card">
  <h3>★ 다음 수집 추천 (Top 5)</h3>
  <table>
    <thead><tr><th>우선순위</th><th>차량 ID</th><th>키워드</th><th>브랜드</th><th>상태</th></tr></thead>
    <tbody>
      <?php foreach (array_slice($next, 0, 5) as $v): ?>
        <tr class="priority-row">
          <td><?= htmlspecialchars($v['priority']) ?></td>
          <td><?= htmlspecialchars($v['id']) ?></td>
          <td><?= htmlspecialchars($v['keyword']) ?></td>
          <td><?= htmlspecialchars($v['brand']) ?></td>
          <td><span class="badge b-<?= str_replace('_','-',$v['status'] ?? 'pending') ?>"><?= htmlspecialchars($v['status'] ?? 'pending') ?></span></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div style="margin-top:.85rem;font-size:.78rem;color:#525252">
    실행 명령 예시 (본인 PC에서):
    <div class="cmd">cd quote-engine<br>
python -m adapters.kb_capital_full --user reekun --vehicles <?= $next[0]['id'] ?? 'avante' ?> --output collected_<?= $next[0]['id'] ?? 'avante' ?>.json<br>
python -m scripts.merge_kb_data --input collected_<?= $next[0]['id'] ?? 'avante' ?>.json</div>
    위 2단계가 끝나면 차보자 사이트가 즉시 정확한 견적 응답.
  </div>
</div>

<div class="card">
  <h3>수집된 트림 목록</h3>
  <table>
    <thead><tr><th>차종</th><th>트림</th><th>가격</th><th>견적수</th><th>완성도</th></tr></thead>
    <tbody>
      <?php foreach ($trims as $t): ?>
        <tr>
          <td><?= htmlspecialchars($t['brand']) ?> <?= htmlspecialchars($t['model_name']) ?></td>
          <td><?= htmlspecialchars($t['trim_name']) ?></td>
          <td><?= number_format($t['base_price']) ?>원</td>
          <td><?= count($t['base_quotes'] ?? []) ?></td>
          <td><span class="badge b-<?= str_replace('_','-',$t['completeness'] ?? 'partial') ?>"><?= htmlspecialchars($t['completeness'] ?? 'partial') ?></span></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div style="font-size:.7rem;color:#a3a3a3;text-align:right;margin-top:1rem">
  차보자 견적 엔진 · <a href="quote_compare_demo.html">데모 페이지</a>
</div>
</body>
</html>

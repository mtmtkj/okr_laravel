<div class="container">
  @if ($currentInputPeriod->name)
  <div class="alert alert-{{ $alertLevel }}">
    ただいま{{ $currentInputPeriod->name }}の入力期間です ({{ $currentInputPeriod->end_at->format('Y-m-d H:i:s') }}まで！)
  </div>
  @else
  <div class="alert alert-info">
    現在入力期間ではありません。
  </div>
  @endif
</div>
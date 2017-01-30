<div class="container">
  <div class="alert alert-{{ $currentPeriod->alertLevel() }}">
    {{ $currentPeriod->guideMessage() }}
  </div>
</div>
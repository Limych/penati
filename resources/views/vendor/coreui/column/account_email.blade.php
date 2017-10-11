@if (!empty($value))
    @if(false !== filter_var($value, FILTER_VALIDATE_EMAIL))
        {!! HTML::mailto($value, $value) !!}
    @else
        <span class="text-danger">@lang('http.display.account_locked')</span>
    @endif
@endif
{!! $append !!}

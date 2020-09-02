@if($type==1)
<button type="button" id="SubmitButton" class="btn save-btn">حفظ</button>
@elseif($type==2)
<button type="button" style="height: 42px" id="{{ $id }}" onclick="{{ $onclick }}" class="btn {{ $class }}">{{ $title }}</button>
@endif
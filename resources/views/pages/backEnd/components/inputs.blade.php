@if($input['type']==1)
<div class="{{ $input['class'] }}">
    <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
    <div class="form-group InputGroup">
        <input type="text" id="{{ $input['id'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] }}" class="form-control numric NameCrop">
    </div>
    <p style="float: left">{{ $input['placeholder'] }}</p>
    <div id="{{ $input['id'] }}_demo"></div>
</div>
@elseif($input['type']==2)

<div class="{{ $input['class'] }}">
    <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
    <div class="form-group InputGroup">
        <input type="number" min="{{ @$input['min'] }}" max="{{ @$input['max'] }}" id="{{ $input['id'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] }}" class="form-control numric NameCrop">
    </div>
    
    <p style="float: left">{{ $input['placeholder'] }}</p>
    <div id="{{ $input['id'] }}_demo"></div>
    
</div>
{{--code bian--}}
@elseif($input['type']==15)

<div class="{{ $input['class'] }}">
    <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
    <div class="form-group InputGroup">
        <input type="text" min="{{ @$input['min'] }}" max="{{ @$input['max'] }}" id="{{ $input['id'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] }}" class="form-control numric NameCrop">
    </div>
    
    <p style="float: left">{{ $input['placeholder'] }}</p>
    <div id="{{ $input['id'] }}_demo"></div>
    
</div>
@elseif($input['type']==3)
<div class="{{ $input['class'] }}">
    <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
    <div class="form-group InputGroup">
        <input type="email" id="{{ $input['id'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] }}" class="form-control numric NameCrop">
    </div>
    <p style="float: left">{{ $input['placeholder'] }}</p>
    <div id="{{ $input['id'] }}_demo"></div>
</div>
@elseif($input['type']==4)
<input type="hidden" id="{{ $input['id'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] }}" class="form-control numric NameCrop">
@elseif($input['type']==5)
<div class="{{ $input['class'] }}">
    <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
    <div class="form-group InputGroup">
        <input type="password" id="{{ $input['id'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] }}" class="form-control numric NameCrop">
    </div>
    <p style="float: left">{{ $input['placeholder'] }}</p>
    <div id="{{ $input['id'] }}_demo"></div>
</div>
@elseif($input['type']==6)
<div class="{{ $input['class'] }}">
    <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
    <div class="form-group InputGroup">
        <input type="date" id="{{ $input['id'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] }}" class="form-control numric NameCrop">
    </div>
    <p style="float: left">{{ $input['placeholder'] }}</p>
    <div id="{{ $input['id'] }}_demo"></div>
</div>
@elseif($input['type']==7)
<div class="{{ $input['class'] }}">
    <input type="hidden" name="name" value="{{ $input['name'] }}" />
    <input type="file" name="{{ $input['name'] }}" data-id="form_upload2" id="{{ $input['id'] }}"  class="inputfileEnter inputfile inputfile-1 upload" data-multiple-caption="{count} files selected"
    />
    <label for="{{ $input['id'] }}">
        <span>{{ $input['title'] }}&hellip;</span>
    </label>
    <a target="_blank" href="{{ $input['value'] }}" id="uploaded_file">الملف</a>
    <div id="{{ $input['id'] }}_demo"></div>
</div>
@elseif($input['type']==8)
<div class="{{ $input['class'] }} {{ $input['buckup'] }}">
    <div class="row">
          
         {{--
            @for($i=1;$i<=$input['countRow'];$i++)
                @foreach ($input['types'] as $key=>$value)
                
                @php
                    $inputRow=[
                        'type'=>$value,
                        'class'=>$input['mainClass'],
                        'name'=>$input['name'][$key].'[]',
                        'id'=>$input['id'][$key],
                        'value'=>$input['value'][$i-1][$input['name'][$key]],
                        'title'=>$input['title'][$key],
                        'placeholder'=>$input['placeholder'][$key],
                    ];
                    
                @endphp

                @if(in_array($value,[11,12]))
                    @php
                        $inputRow['selector']=$input['selector'][$key];
                        $inputRow['options']=$input['options'][$key];
                    @endphp
                @endif
                @component('pages.backEnd.components.inputs',['input'=>$inputRow])
                @endcomponent
            @endforeach
        @endfor
        
         --}}
    </div>
</div>
<div class="{{ $input['class'] }} {{ $input['container'] }}"></div>
@elseif($input['type']==9)
    <div class="{{ $input['class'] }}">
        <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
        <div class="form-group InputGroup">
            <textarea  id="{{ $input['id'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] }}" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <p style="float: left">{{ $input['placeholder'] }}</p>
        <div id="{{ $input['id'] }}_demo"></div>
    </div>
@elseif($input['type']==10)
    <div class="{{ $input['class'] }}">
            <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
        <div class="form-group ">
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" name="{{ $input['name'] }}" id="{{ $input['id'] }}" value="{{ $input['value']['point']}}" class="form-control numric loc"
                            placeholder="{{ $input['placeholder'] }} ">
                    <div id="{{ $input['id'] }}_demo"></div>
                </div>
                <div class="col-sm-7">
                    <div class="box_point1">
                        <div class="row">
                            <div class="col-sm-3 p-0">
                                <input type="text" name="north[]" value="{{ $input['value']['north'][0]}}" class="form-control numric loc"
                                        placeholder="شمال ">
                            </div>
                            <div class="col-sm-3 p-0">

                                <input name="degree[]" type="text" value="{{ $input['value']['north'][1]}}" class="form-control numric loc1"
                                        placeholder="درجه">
                            </div>
                            <div class="col-sm-3 p-0">

                                <input name="minute[]" type="text" value="{{ $input['value']['north'][2]}}" class="form-control numric loc1"
                                        placeholder="دقيقه">
                            </div>
                            <div class="col-sm-3 p-0">

                                <input name="second[]" type="text" value="{{ $input['value']['north'][3]}}" class="form-control numric loc1"
                                        placeholder="ثانيه">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-7 offset-sm-4">
                    <div class="box_point1">
                        <div class="row">
                            <div class="col-sm-3 p-0">
                                <input type="text" name="east[]"  value="{{ $input['value']['east'][0]}}"  class="form-control numric loc"
                                        placeholder="شرق ">
                            </div>
                            <div class="col-sm-3 p-0">
                                <input name="degree[]" type="text" value="{{ $input['value']['east'][1]}}" class="form-control numric loc1"
                                        placeholder="درجه">
                            </div>
                            <div class="col-sm-3 p-0">
                                <input name="minute[]" type="text" value="{{ $input['value']['east'][2]}}" class="form-control numric loc1"
                                        placeholder="دقيقه">
                            </div>
                            <div class="col-sm-3 p-0">
                                <input name="second[]" type="text" value="{{ $input['value']['east'][3]}}" class="form-control numric loc1"
                                        placeholder="ثانيه">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($input['type']==11)
    <div class="{{ $input['class'] }}">
            <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
        <select class="add_model_employee numric form-control" name="{{ $input['name'] }}" style="width: 100%;">
                <option value="">لا شىء</option>
            @foreach ($input['options'] as $value)
            
                @if($value->id==$input['value'])
                    <option value="{{ $value->id }}" selected>{{ $value->{$input['selector']} }}</option>
                @else
                    <option value="{{ $value->id }}">{{ $value->{$input['selector']} }}</option>
                @endif
            @endforeach
        </select>
        <p style="float: left">{{ $input['placeholder'] }}</p>
        <div id="{{ $input['id'] }}_demo"></div>
    </div>
@elseif($input['type']==12)
    <div class="{{ $input['class'] }}">
            <label for="{{ $input['id'] }}">{{ $input['title'] }}</label>
        <select class="add_model_employee numric form-control select2" name="{{ $input['name'] }}" multiple="multiple" style="width: 100%;">
            
            @foreach ($input['options'] as $value)
                @if(in_array($value->id,$input['value']))
                    <option value="{{ $value->id }}" selected>{{ $value->{$input['selector']} }}</option>
                @else
                    <option value="{{ $value->id }}">{{ $value->{$input['selector']} }}</option>
                @endif
            @endforeach
        </select>
        <p style="float: left">{{ $input['placeholder'] }}</p>
        <div id="{{ $input['id'] }}_demo"></div>
    </div>
@endif
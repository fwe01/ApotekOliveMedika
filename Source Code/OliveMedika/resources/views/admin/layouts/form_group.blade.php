@php
    if(!isset($value)){
        $value = null;
    }
    if(!isset($hidden)){
        $hidden = false;
    }
	if(!isset($readonly)){
        $readonly = false;
    }
@endphp
<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" style="font-weight:bold;">{{$label}}</label>
    @if($required)<p style="color:red;">*</p> @endif
    <div class="col-md-6">
        @if($type == 'select')
            <select class="select2 select2-hidden-accessible" name="{{$name}}" id="{{$id_input}}" style="width: 100%">
                <option value=""> Pilih {{$label}}</option>
                @foreach($options as $label=>$option)
                    <option value="{{$option}}" @if($value && $value == $option) selected @endif> {{$label}}</option>
                @endforeach
            </select>
        @elseif($type == 'datetime')
            <div class="form-group">
                <div class="input-group date date-input" id="{{$id_input}}" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" name="{{$name}}"
                           data-target="#{{$id_input}}" value="{{$value ?? ""}}">
                    <div class="input-group-append" data-target="#{{$id_input}}" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        @else
            <input id={{$id_input}} name="{{$name}}" type="{{$type}}" class="form-control" value="{{$value ?? ""}}"
                   @if($required) required @endif @if($hidden) hidden @endif @if($readonly) readonly @endif
                   oninvalid="this.setCustomValidity('Data belum terisi.')"
                   oninput="this.setCustomValidity('')"
            >
        @endif
    </div>
</div>
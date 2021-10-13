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
    <label class="offset-md-1 col-md-4 col-form-label text-md-left" style="font-weight:bold;">{{$label}}
        @if($required)<p style="color:red; display: inline">*</p>@endif
    </label>
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
        @elseif($type == 'image')
            <div class="form-group">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="{{$id_input}}" name="{{$name}}"
                               value="{{$value ?? ""}}" @if($required) required @endif accept="image/*"
                               onchange="updateFilename(this)">
                        <label class="custom-file-label"
                               for="{{$id_input}}">{{$value !== '' ? str_replace('public/OliveMedika/img/', '', $value) : "Pilih file"}}</label>
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
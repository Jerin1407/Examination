@extends('layouts.app')

@section('title', 'Add New Question')

@section('content')

<div class="container">
 
    <h3>Add New</h3>
 
    <div class="row">
        <form method="post" id="qf" action="">
            @csrf
 
            <div class="col-md-12">
                <br>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
 
                        <div class="form-group">
                            Multiple Choice Multiple Answer
                        </div>
 
                        <div class="form-group">
                            <label for="cid">Select Category</label>
                            <select class="form-control" name="cid" id="cid">
                                    <option value="">category_name</option>
                            </select>
                        </div>
 
                        <div class="form-group">
                            <label for="lid">Select Level</label>
                            <select class="form-control" name="lid" id="lid">
                                    <option value="">level_name</option>
                            </select>
                        </div>
 
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="paragraph">Paragraph : English</label>
                                        <textarea id="paragraph" name="paragraph" class="form-control">{{ old('paragraph', isset($qp) ? $qp['paragraph'] : '') }}</textarea>
                                    </div>
                                </div>
 
                        @foreach ($lang as $lkey => $val)
                            @php $lno = $lkey == 0 ? '' : $lkey; @endphp
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="question{{ $lno }}">{{ __('lang.question') }} : {{ $val }}</label>
                                    <textarea id="question{{ $lno }}" name="question{{ $lno }}" class="form-control">{{ old('question' . $lno) }}</textarea>
                                </div>
                            </div>
                        @endforeach
 
                        @foreach ($lang as $lkey => $val)
                            @php $lno = $lkey == 0 ? '' : $lkey; @endphp
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description{{ $lno }}">{{ __('lang.description') }} : {{ $val }}</label>
                                    <textarea id="description{{ $lno }}" name="description{{ $lno }}" class="form-control">{{ old('description' . $lno) }}</textarea>
                                </div>
                            </div>
                        @endforeach
 
                        @for ($i = 1; $i <= $nop; $i++)
                            <div class="row">
                                @foreach ($lang as $lkey => $val)
                                    @php $lno = $lkey == 0 ? '' : $lkey; @endphp
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('lang.options') }} {{ $i }}) : {{ $val }}</label> <br>
 
                                            @if ($lkey == 0)
                                                <input type="checkbox" name="score[]" value="{{ $i - 1 }}"
                                                       @checked(in_array($i - 1, old('score', [0])))> Select Correct Option
                                            @endif
                                            <br>
 
                                            <textarea name="option{{ $lno }}[]" class="form-control">{{ old("option{$lno}." . ($i - 1)) }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endfor
 
                        <input type="hidden" name="parag" id="parag" value="0">
                        <button class="btn btn-default" type="submit">{{ __('lang.submit') }}</button>
 
                        @if ($para == 1)
                            <button class="btn btn-default" type="button" onclick="javascript:parags();">{{ __('lang.submit&add') }}</button>
                        @endif
 
                    </div>
                </div>
            </div>
        </form>
    </div>
 
</div>
 
<script>
    function parags() {
        $('#parag').val('1');
        $('#qf').submit();
    }
</script>

@endsection
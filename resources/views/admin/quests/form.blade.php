<div class="form-group">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="string" id="name" value="{{ $quest->name or ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('daily') ? 'has-error' : ''}}">
    <div class="col-md-6">
        <div class="radio">
            <label><input name="daily" type="radio"
                          value="1" @if (isset($quest)) {{ (1 == $quest->daily) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                daily</label>
        </div>
        <div class="radio">
            <label><input name="daily" type="radio"
                          value="0" @if (isset($quest)) {{ (0 == $quest->daily) ? 'checked' : '' }} @endif>
                linear</label>
        </div>
        {!! $errors->first('daily', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('typeID') ? 'has-error' : ''}}" id="questType">
    <label for="typeID" class="col-md-4 control-label">{{ 'Type' }}</label>
    <div class="col-md-6">
        <select name="typeID" class="form-control" id="typeID">
            @foreach ($types as $value)
                <option value="{{ $value->ID }}" {{ (isset($quest->typeID) && $quest->typeID == $value->ID) ? 'selected' : ''}}>{{ $value->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('typeID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if(isset($quest))
    @isset($items)
        @include('admin.quests.item', ['name' => $quest->field->fieldname->name, 'ID' => $quest->field->fieldName->ID, 'inputType' => $quest->field->fieldName->type])
    @endisset
@else
    @include('admin.quests.item', ['name' => $field->name, 'ID' => $field->ID,  'inputType' => $field->type])
@endif

<div class="form-group {{ $errors->has('countToDo') ? 'has-error' : ''}}">
    <label for="countToDo" class="col-md-4 control-label">{{ 'CountToDo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="countToDo" type="number" id="countToDo" value="{{ $quest->countToDo or 0}}">
        {!! $errors->first('countToDo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('level') ? 'has-error' : ''}}">
    <label for="level" class="col-md-4 control-label">{{ 'Level' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="level" type="number" id="level" value="{{ $quest->level or 0}}">
        {!! $errors->first('level', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('starPoints') ? 'has-error' : ''}}">
    <label for="starPoints" class="col-md-4 control-label">{{ 'StarPoints' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="starPoints" type="number" id="starPoints"
               value="{{ $quest->starPoints or 0}}">
        {!! $errors->first('starPoints', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('rewardID') ? 'has-error' : ''}}">
    <label for="rewardID" class="col-md-4 control-label">{{ 'Reward' }}</label>
    <div class="col-md-6">
        <select name="rewardID" class="form-control" id="rewardID">
            @foreach ($rewards as $value)
                <option value="{{ $value->ID }}" {{ (isset($quest->rewardID) && $quest->rewardID == $value->ID) ? 'selected' : ''}}>{{ $value->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('rewardID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--<div id="dialogCard1" class="card @if(!isset($quest) || $quest->daily == 1){{ 'd-none' }}@endif">--}}
    {{--<div class="card-header"><h5>Begin Dialog</h5></div>--}}
    {{--<div class="card-body">--}}
        {{--<table class="table table-bordered">--}}
            {{--<tr>--}}
                {{--<th>Description</th>--}}
                {{--<th>Speaker</th>--}}

                {{--<th>--}}
                    {{--<button type="button" class="addDescription btn btn-success">Add</button>--}}
                {{--</th>--}}
            {{--</tr>--}}

            {{--<tbody>--}}
            {{--@isset($beginDialog)--}}
                {{--@foreach($beginDialog->descriptions->sortBy('number') as $value)--}}

                    {{--@include('admin.dialogs.description', ['index' => $loop->index, 'name' => 'beginDescriptions'])--}}

                {{--@endforeach--}}
            {{--@endisset--}}
            {{--</tbody>--}}

        {{--</table>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div id="dialogCard2" class="card @if(!isset($quest) || $quest->daily == 1){{ 'd-none' }}@endif">--}}
    {{--<div class="card-header"><h5>Additional Dialog</h5></div>--}}
    {{--<div class="card-body">--}}
        {{--<table class="table table-bordered">--}}
            {{--<tr>--}}
                {{--<th>Description</th>--}}
                {{--<th>Speaker</th>--}}

                {{--<th>--}}
                    {{--<button type="button" class="addDescription btn btn-success">Add</button>--}}
                {{--</th>--}}
            {{--</tr>--}}

            {{--<tbody>--}}
            {{--@isset($additionalDialog)--}}
                {{--@foreach($additionalDialog->descriptions->sortBy('number') as $value)--}}

                    {{--@include('admin.dialogs.description', ['index' => $loop->index, 'name' => 'additionalDescriptions'])--}}

                {{--@endforeach--}}
            {{--@endisset--}}
            {{--</tbody>--}}

        {{--</table>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="card" style="margin: 15px 0 15px 0">
    <div class="card-header"><h5>Quest descriptions</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                @foreach
                <tr>
                    <td {{ in_array($loop->index, [0,3,4]) }}colspan="2" bgcolor="#faffef">
                        <label>Header Text</label>
                        <nav>
                            <div class="nav nav-tabs" id="headerText">
                                @foreach($languages as $language)
                                    <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}" href="#{{ $language->language }}"></a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="headerTextContent">
                            @isset($questdescription)
                                @foreach($questdescriptions->where('mode', 0)->first()->description->localizations as $localization)
                                    <div role="tabpanel" class="tab-pane fade show active"
                                         id="{{ $localization->language->language }}"
                                         aria-labelledby="{{ $localization->language->language }}-tab"></div>
                                @endforeach
                            @endisset
                        </div>
                        {{--<input class="form-control" name="data[0][textKey]"--}}
                        {{--value="{{ isset($questdescription) ? $questdescription->values()[0]['textKey'] : '' }}">--}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td bgcolor="#faffef">
                        <label>Left Text</label>
                        <nav>
                            <div class="nav nav-tabs" id="headerText">
                                @foreach($languages as $language)
                                    <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}" href="#{{ $language->language }}"></a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="headerTextContent">
                            @isset($questdescription)
                                @foreach($questdescriptions->where('mode', 1)->first()->description->localizations as $localization)
                                    <div role="tabpanel" class="tab-pane fade show active"
                                         id="{{ $localization->language->language }}"
                                         aria-labelledby="{{ $localization->language->language }}-tab"></div>
                                @endforeach
                            @endisset
                        </div>
                        {{--<input class="form-control" name="data[1][textKey]"--}}
                        {{--value="{{ isset($questdescription) ? $questdescription->values()[1]['textKey'] : '' }}">--}}
                    </td>
                    <td bgcolor="#fff0d7">
                        <label>Right Image</label>
                        <input class="form-control" name="data[1][imageName]"
                               value="{{ isset($questdescription) ? $questdescription->values()[1]['imageName'] : '' }}">
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#fff0d7">
                        <label>Left Image</label>
                        <input class="form-control" name="data[2][imageName]"
                               value="{{ isset($questdescription) ? $questdescription->values()[2]['textKey'] : '' }}">
                    </td>
                    <td bgcolor="#faffef">
                        <label>Right Text</label>
                        <nav>
                            <div class="nav nav-tabs" id="headerText">
                                @foreach($languages as $language)
                                    <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}" href="#{{ $language->language }}"></a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="headerTextContent">
                            @foreach($languages as $language)
                                <div role="tabpanel" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $language->language }}"
                                aria-labelledby="{{ $language->language }}-tab">
                                    <textarea class="form-control" name="questdescription[{{ $language->ID }}][description]">
                                        {{ isset($questdescriptions) ?
                                        $questdescriptions->where('mode', 0)->first()
                                        ->description->localizations->where('languageID', $language->ID) : '' }}
                                    </textarea>
                                </div>
                                @endforeach
                                {{--@isset($questdescription)--}}
                            {{--@foreach($questdescriptions->where('mode', 2)->first()->description->localizations as $localization)--}}
                            {{--<div role="tabpanel" class="tab-pane fade show active" id="{{ $localization->language->language }}"--}}
                            {{--aria-labelledby="{{ $localization->language->language }}-tab"></div>--}}
                            {{--@endforeach--}}
                            {{--@endisset--}}
                        </div>
                        {{--<input class="form-control" name="data[2][textKey]"--}}
                        {{--value="{{ isset($questdescription) ? $questdescription->values()[2]['imageName'] : '' }}">--}}
                    </td>

                </tr>
                <tr bgcolor="#faffef">
                    <td colspan="2">
                        <label>Wide Text</label>
                        <nav>
                            <div class="nav nav-tabs" id="headerText">
                                @foreach($languages as $language)
                                    <a class="nav-item nav-link active" href="{{ $language->language }}"></a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="headerTextContent">
                            @isset($questdescription)
                                @foreach($questdescriptions->where('mode', 3)->first()->description->localizations as $localization)
                                    <div role="tabpanel" class="tab-pane fade show active"
                                         id="{{ $localization->language->language }}"
                                         aria-labelledby="{{ $localization->language->language }}-tab"></div>
                                @endforeach
                            @endisset
                        </div>
                        {{--<input class="form-control" name="data[3][textKey]"--}}
                        {{--value="{{ isset($questdescription) ? $questdescription->values()[3]['textKey'] : '' }}">--}}
                    </td>
                </tr>
                <tr bgcolor="#fff0d7">
                    <td colspan="2">
                        <label>Wide Image</label>
                        <input class="form-control" name="data[4][imageName]"
                               value="{{ isset($questdescription) ? $questdescription->values()[4]['imageName'] : '' }}">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>

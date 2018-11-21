<label>{{ $mode->name }}</label>
<nav>
    <div class="nav nav-tabs" id="{{ $mode->name }}" role="tablist">
        @foreach($languages as $language)
            <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}"
               id="nav-{{ $language->language.$mode->index }}-tab"
               href="#nav-{{ $language->language.$mode->index }}"
               role="tab" aria-controls="nav-{{ $language->language.$mode->index }}"
               data-toggle="tab"
               aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $language->language }}</a>
        @endforeach
    </div>
</nav>
<div class="tab-content" id="{{ $mode->name }}Content">
    @isset($questdescriptions)

        @foreach($questdescriptions->where('mode', $mode->index)->first()->description->localizations as $localization)

            <div class="tab-pane fade{{ $loop->first ? ' show active' : '' }}"
                 id="nav-{{ $localization->language->language.$mode->index }}"
                 role="tabpanel"
                 aria-labelledby="nav-{{ $localization->language->language.$mode->index }}-tab">

                        <textarea class="form-control"
                                  name="{{ 'questdescriptions['.$mode->index.'][localizations]['.$localization->language->ID.']' }}"
                                  cols="3">
                        {{ $localization->text }}
                        </textarea>
            </div>
        @endforeach
    @endisset
</div>
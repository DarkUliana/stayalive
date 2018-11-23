<label>Key</label>

<input class="form-control" type="text" name="{{ 'questdescriptions['.$mode->index.'][textKey]'}}"
       value="{{ ($description) ? $description->textKey : '' }}"
        {{ ($description && $description->description) ? 'readonly' : '' }}>
<br>
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

    @foreach($languages as $language)

        @php
        $localization = ($description && $description->description && $description->description->localizations) ?
        $description->description->localizations->where('languageID', $language->ID)->first() : null;
        @endphp
            <div class="tab-pane fade{{ $loop->first ? ' show active' : '' }}"
                 id="nav-{{ $language->language.$mode->index }}"
                 role="tabpanel"
                 aria-labelledby="nav-{{ $language->language.$mode->index }}-tab">

                <div class="form-group">
                        <textarea class="form-control"
                                  name="{{ 'questdescriptions['.$mode->index.'][localizations]['.$language->ID.']' }}"
                                  rows="3">{{ $localization ? $localization->description : '' }}</textarea>
                </div>
            </div>
        @endforeach
</div>
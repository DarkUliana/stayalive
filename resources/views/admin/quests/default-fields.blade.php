<input type="hidden" name="{{ 'questdescriptions['.$mode->index.'][questDescriptionID]'}}"
       value="{{ ($description) ? $description->ID : null }}">

<input type="hidden" name="{{ 'questdescriptions['.$mode->index.'][descriptionID]'}}"
       value="{{ ($description && $description->description) ? $description->description->ID : null }}">
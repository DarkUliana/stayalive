<input type="hidden" name="{{ 'questdescriptions['.$index.'][mode]'}}" value="{{ $mode }}">
<input type="hidden" name="{{ 'questdescriptions['.$index.'][questDescriptionID]'}}"
       value="{{ isset($description) ? $description->ID : null }}">

<input type="hidden" name="{{ 'questdescriptions['.$index.'][descriptionID]'}}"
       value="{{ (isset($description) && $description->description) ? $description->description->ID : null }}">
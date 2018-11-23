<label>Image name</label>
<input type="text" name="{{ 'questdescriptions['.$index.'][imageName]'}}" class="form-control"
       value="{{ isset($description) ? $description->imageName : '' }}">
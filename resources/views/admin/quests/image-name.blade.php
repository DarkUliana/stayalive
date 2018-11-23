<label>Image name</label>
<input type="text" name="{{ 'questdescriptions['.$mode->index.'][imageName]'}}" class="form-control"
       value="{{ $description ?
       $description->imageName : '' }}">
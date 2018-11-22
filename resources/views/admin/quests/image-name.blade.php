<label>Image name</label>
<input type="text" name="{{ 'questdescriptions['.$mode->index.'][imageName]'}}" class="form-control"
       value="{{ $questdescriptions->where('mode', $mode->index)->first() ?
       $questdescriptions->where('mode', $mode->index)->first()->imageName : '' }}">
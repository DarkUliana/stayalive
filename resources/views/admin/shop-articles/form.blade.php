<div class="form-group {{ $errors->has('shopID') ? 'has-error' : ''}}">
    <label for="shopID" class="col-md-4 control-label">{{ 'ShopID' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="shopID" type="text" id="shopID" value="{{ $shopArticle->shopID or ''}}">
        {!! $errors->first('shopID', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('shopItemCategory') ? 'has-error' : ''}}">
    <label for="shopItemCategory" class="col-md-4 control-label">{{ 'ShopItemCategory' }}</label>
    <div class="col-md-6">
        <select name="shopItemCategory" class="form-control" id="shopItemCategory">
            @foreach (json_decode('{"0":"None", "1":"Equipment", "2":"Resource", "3":"Coin"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($shopArticle->shopItemCategory) && $shopArticle->shopItemCategory == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('shopItemCategory', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('inGold') ? 'has-error' : ''}}">
    <label for="inGold" class="col-md-4 control-label">{{ 'InGold' }}</label>
    <div class="col-md-6">
        <div class="radio">
            <label><input name="inGold" type="radio"
                          value="1" {{ (isset($shopArticle) && 1 == $shopArticle->inGold) ? 'checked' : '' }}>
                Yes</label>
        </div>
        <div class="radio">
            <label><input name="inGold" type="radio"
                          value="0" @if (isset($shopArticle)) {{ (0 == $shopArticle->inGold) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                No</label>
        </div>
        {!! $errors->first('inGold', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="number" id="price" step="0.01" value="{{ $shopArticle->price or 0}}">
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('sale') ? 'has-error' : ''}}">
    <label for="sale" class="col-md-4 control-label">{{ 'Sale' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sale" type="number" id="sale" step="0.01" value="{{ $shopArticle->sale or 0}}">
        {!! $errors->first('sale', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('hot') ? 'has-error' : ''}}">
    <label for="hot" class="col-md-4 control-label">{{ 'Hot' }}</label>
    <div class="col-md-6">
        <div class="radio">
            <label><input name="hot" type="radio"
                          value="1" {{ (isset($shopArticle) && 1 == $shopArticle->hot) ? 'checked' : '' }}> Yes</label>
        </div>
        <div class="radio">
            <label><input name="hot" type="radio"
                          value="0" @if (isset($shopArticle)) {{ (0 == $shopArticle->hot) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                No</label>
        </div>
        {!! $errors->first('hot', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('shopItemType') ? 'has-error' : ''}}">
    <label for="shopItemType" class="col-md-4 control-label">{{ 'ShopItemType' }}</label>
    <div class="col-md-6">
        <select name="shopItemType" class="form-control" id="shopItemType">
            @foreach (json_decode('{"1":"Simple", "4":"Pack", "8":"Superpack"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($shopArticle->shopItemType) && $shopArticle->shopItemType == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('shopItemType', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('dateTime') ? 'has-error' : ''}}" id="dateTimeDiv">
    <label for="datTime" class="col-md-4 control-label">{{ 'DateTime (the end date of sales)' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="dateTime" type="datetime-local" id="datTime"
               value="{{ $shopArticle->dateTime or date('Y-m-d\TH:i')}}">
        {!! $errors->first('dateTime', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>ImageName</th>
        <th>Count</th>
        <th>InStack</th>
        <th>
            <button id="addShopItem" type="button" class="btn btn-success">Add</button>
        </th>
    </tr>

    @isset($shopArticle)
        <?php $counter = 0; ?>
        @foreach($shopArticle->items as $item)
            @include('admin.shop-articles.item')
            <?php ++$counter ?>
        @endforeach
    @endisset
</table>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>

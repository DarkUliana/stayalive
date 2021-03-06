<tr>
    <th>
        Enemy type
    </th>
    <td>
        <select name="enemyType" class="form-control" id="enemyType">
            @foreach ($enemies as $enemy)
                <option value="{{ $enemy->ID }}" {{ ((isset($mob->enemyType) && $mob->enemyType == $enemy->ID) || (isset($currentEnemy) && $currentEnemy->ID == $enemy->ID)) ? 'selected' : ''}}>{{ $enemy->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('enemyType', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
<tr>
    <th>
        Enemy level
    </th>
    <td>
        <input class="form-control" name="enemyLevel" type="number" id="enemyLevel"
               value="{{ $mob->enemyLevel or ''}}" required>
        {!! $errors->first('enemyLevel', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
<tr>
    <th>
        Peace radius
    </th>
    <td>
        <input class="form-control" name="peaceRadius" type="number" step="0.01"
               id="peaceRadius" value="{{ $mob->peaceRadius or ''}}" required>
        {!! $errors->first('peaceRadius', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
<tr>
    <th>
        Maximum HP
    </th>
    <td>
        <input class="form-control" name="maximumHP" type="number" id="maximumHP"
               value="{{ $mob->maximumHP or ''}}" required>
        {!! $errors->first('maximumHP', '<p class="help-block">:message</p>') !!}
    </td>
</tr>

<tr>
    <th>
        Player detect radius
    </th>
    <td>
        <input class="form-control" name="playerDetectRadius" type="number" step="0.001"
               id="playerDetectRadius"
               value="{{ $mob->playerDetectRadius or ''}}" required>
        {!! $errors->first('playerDetectRadius', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
<tr>
    <th>
        Call radius
    </th>
    <td>
        <input class="form-control" name="callRadius" type="number" step="0.001" id="callRadius"
               value="{{ $mob->callRadius or ''}}" required>
        {!! $errors->first('callRadius', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
<tr>
    <th>
        Add agro radius
    </th>
    <td>
        <input class="form-control" name="addAgroRadius" type="number" step="0.001" id="addAgroRadius"
               value="{{ $mob->addAgroRadius or ''}}" required>
        {!! $errors->first('addAgroRadius', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
<tr>
    <th>
        Give expirience
    </th>
    <td>
        <input class="form-control" name="giveExpirience" type="number" id="giveExpirience"
               value="{{ $mob->giveExpirience or ''}}" required>
        {!! $errors->first('giveExpirience', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
<tr>
    <th>
        Movement speed
    </th>
    <td>
        <input class="form-control" name="movementSpeed" type="number" step="0.001" id="movementSpeed"
               value="{{ $mob->movementSpeed or ''}}" required>
        {!! $errors->first('movementSpeed', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
<tr>
    <th>
        Time to stay
    </th>
    <td>
        <input class="form-control" name="timeToStay" type="number" step="0.001" id="timeToStay"
               value="{{ $mob->timeToStay or ''}}" required>
        {!! $errors->first('timeToStay', '<p class="help-block">:message</p>') !!}
    </td>
</tr>
@if(isset($currentEnemy) && $currentEnemy->attackClose)
    <tr>
        <th>
            Attack close range
        </th>
        <td>
            <input class="form-control" name="attackCloseRange" type="number" step="0.001" id="attackCloseRange"
                   value="{{ $mob->attackCloseRange or ''}}" required>
            {!! $errors->first('attackCloseRange', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Attack close power
        </th>
        <td>
            <input class="form-control" name="attackClosePower" type="number" id="attackClosePower"
                   value="{{ $mob->attackClosePower or ''}}" required>
            {!! $errors->first('attackClosePower', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Attack close rate
        </th>
        <td>
            <input class="form-control" name="attackCloseRate" type="number" step="0.001" id="attackCloseRate"
                   value="{{ $mob->attackCloseRate or ''}}" required>
            {!! $errors->first('attackCloseRate', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
@endif
@if(isset($currentEnemy) && $currentEnemy->attackDistance)
    <tr>
        <th>
            Attack distance range
        </th>
        <td>
            <input class="form-control" name="attackDistanceRange" type="number" step="0.001"
                   id="attackDistanceRange"
                   value="{{ $mob->attackDistanceRange or ''}}" required>
            {!! $errors->first('attackDistanceRange', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Attack distance power
        </th>
        <td>
            <input class="form-control" name="attackDistancePower" type="number" id="attackDistancePower"
                   value="{{ $mob->attackDistancePower or ''}}" required>
            {!! $errors->first('attackDistancePower', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Attack distance rate
        </th>
        <td>
            <input class="form-control" name="attackDistanceRate" type="number" step="0.001"
                   id="attackDistanceRate"
                   value="{{ $mob->attackDistanceRate or ''}}" required>
            {!! $errors->first('attackDistanceRate', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
@endif
@if(isset($currentEnemy) && $currentEnemy->decrease)
    <tr>
        <th>
            Attack speed decrease
        </th>
        <td>
            <input class="form-control" name="attackSpeedDecrease" type="number" step="0.001"
                   id="attackSpeedDecrease"
                   value="{{ $mob->attackSpeedDecrease or ''}}" required>
            {!! $errors->first('attackSpeedDecrease', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>

    <tr>
        <th>
            Movement speed decrease
        </th>
        <td>
            <input class="form-control" name="movementSpeedDecrease" type="number" step="0.001"
                   id="movementSpeedDecrease" value="{{ $mob->movementSpeedDecrease or ''}}" required>
            {!! $errors->first('movementSpeedDecrease', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Time debuff
        </th>
        <td>
            <input class="form-control" name="timeDebuff" type="number" step="0.001" id="timeDebuff"
                   value="{{ $mob->timeDebuff or ''}}" required>
            {!! $errors->first('timeDebuff', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Chance
        </th>
        <td>
            <input class="form-control" name="chance" type="number" step="0.001" id="chance"
                   value="{{ $mob->chance or ''}}" required>
            {!! $errors->first('chance', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
@endif
@if(isset($currentEnemy) && $currentEnemy->increaseSpeed)
    <tr>
        <th>
            Increase speed range
        </th>
        <td>
            <input class="form-control" name="increaseSpeedRange" type="number" step="0.001"
                   id="increaseSpeedRange"
                   value="{{ $mob->increaseSpeedRange or ''}}" required>
            {!! $errors->first('increaseSpeedRange', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Increase speed value
        </th>
        <td>
            <input class="form-control" name="increaseSpeedValue" type="number" step="0.001"
                   id="increaseSpeedValue"
                   value="{{ $mob->increaseSpeedValue or ''}}" required>
            {!! $errors->first('increaseSpeedValue', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Increase speed time
        </th>
        <td>
            <input class="form-control" name="increaseSpeedTime" type="number" step="0.001"
                   id="increaseSpeedTime"
                   value="{{ $mob->increaseSpeedTime or ''}}" required>
            {!! $errors->first('increaseSpeedTime', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
@endif
@if(isset($currentEnemy) && $currentEnemy->hill)

    <tr>
        <th>
            Hill range
        </th>
        <td>
            <input class="form-control" name="hillRange" type="number" step="0.001" id="hillRange"
                   value="{{ $mob->hillRange or ''}}" required>
            {!! $errors->first('hillRange', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Hill power
        </th>
        <td>
            <input class="form-control" name="hillPower" type="number" id="hillPower"
                   value="{{ $mob->hillPower or ''}}" required>
            {!! $errors->first('hillPower', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
    <tr>
        <th>
            Hill rate
        </th>
        <td>
            <input class="form-control" name="hillRate" type="number" step="0.001" id="hillRate"
                   value="{{ $mob->hillRate or ''}}" required>
            {!! $errors->first('hillRate', '<p class="help-block">:message</p>') !!}
        </td>
    </tr>
@endif
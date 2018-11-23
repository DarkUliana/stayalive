<tr data-index="{{ $index }}">
    <td style="background: #f0ffda">
        @include('admin.quests.default-fields')
        @include('admin.quests.localizations')
    </td>
    <td style="background: #fff0d7">
        @include('admin.quests.image-name')
    </td>
    @include('admin.quests.delete')
</tr>
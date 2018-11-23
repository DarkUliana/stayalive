<tr data-index="{{ $index }}">
    <td style="background: #fff0d7">
        @include('admin.quests.default-fields')
        @include('admin.quests.image-name')
    </td>
    <td style="background: #f0ffda">
        @include('admin.quests.localizations')
    </td>
    @include('admin.quests.delete')
</tr>
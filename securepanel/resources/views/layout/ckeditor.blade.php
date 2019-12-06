@php
$languages = AdminHelper::getLanguages();
@endphp
<script>
$(function () {
@foreach($languages as $language)
    @if ($language['code'] == 'AR')
        CKEDITOR.replace('{{$language['name']}}[description]', {
            language : 'ar'
        });
    @else
        CKEDITOR.replace('{{$language['name']}}[description]');
    @endif
@endforeach
});
</script>
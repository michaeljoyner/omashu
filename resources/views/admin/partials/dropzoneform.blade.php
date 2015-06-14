<div id="{{ $previewId }}" class="dropzone-previews image-preview-box">
    <div class="dz-preview">
        <div class="dz-image">
            @if(! is_null($currentImg))
            <img src="{{ $currentImg }}" alt=""/>
            @endif
        </div>
    </div>
</div>
<form action="{{ $uploadURL }}" class="dropzone" id="{{ $dzFormId }}">

</form>
<div {{ $attributes->merge(['class' => 'col-12 row justify-content-center']) }}>
    <div id="panel" class="panel card col-10 my-5 p-5">
        {{ $slot }}
    </div>
</div>
<div class="table-wrapper col-13 row">
    <table {{ $attributes->merge(['class' => 'table table-striped table-bordered text-center']) }} >
        <thead class="table-info">
            <tr>
			    {{ $thead }}
            </tr>
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-2">
        {{ $links }}
    </div>
</div>
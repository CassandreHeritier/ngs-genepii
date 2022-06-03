<!-- <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
</div>

<div class="modal"></div> -->

<div id="loader" class="panel card col-sm-10" style="margin-top:2rem" v-if="loading">
    <i id="load_spin" class="fa fa-cog fa-spin fa-fw"></i>
    <div id="load_text">
        <p>Chargement, veuillez patienter...</p>
    </div>
</div>
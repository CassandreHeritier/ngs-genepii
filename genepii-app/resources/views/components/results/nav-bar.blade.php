<x-results.nav-tabs>
    <x-results.nav-item tab="{{ $tab }}" />
    <x-results.nav-item name="samples" tab="{{ $tab }}">Prélèvements</x-results.nav-item>
    <x-results.nav-item name="medical-files" tab="{{ $tab }}">Dossiers médicaux</x-results.nav-item>
    <x-results.nav-item name="patients" tab="{{ $tab }}">Patients</x-results.nav-item>
    <x-results.nav-item name="sender-labs" tab="{{ $tab }}">Laboratoires expéditeurs</x-results.nav-item>
    <x-results.nav-item name="sampler-labs" tab="{{ $tab }}">Laboratoires préleveurs</x-results.nav-item>
    <x-results.nav-item name="samplesheets" tab="{{ $tab }}">Samplesheets</x-results.nav-item>
    <x-results.nav-item name="extractions" tab="{{ $tab }}">Extractions</x-results.nav-item>
    <x-results.nav-item name="bioinfo-runs" tab="{{ $tab }}">Runs Bioinfo</x-results.nav-item>
    <x-results.nav-item name="nextclade-results" tab="{{ $tab }}">Résultats Nextclade</x-results.nav-item>
    <x-results.nav-item name="pangolin-results" tab="{{ $tab }}">Résultats Pangolin</x-results.nav-item>
    <x-results.nav-item name="summary-results" tab="{{ $tab }}">Résultats Summary</x-results.nav-item>
    <x-results.nav-item name="validation-results" tab="{{ $tab }}">Résultats Validation</x-results.nav-item>
</x-results.nav-tabs>
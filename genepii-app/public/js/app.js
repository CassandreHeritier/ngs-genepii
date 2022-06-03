/* Checkboxes - Download results */
let ids = []; // list of checked elements ids
const checkAll = document.getElementsByName('checkAll')[0];
const checkboxes = document.getElementsByName('checkbox');
var count = 0;

if (checkAll) {
  checkAll.addEventListener('click', function handleClick(event) {
    $(':checkbox').each(function () {
      this.checked = checkAll.checked;
    });
    if (checkAll.checked) {
      document.getElementById('export').disabled = false; // enable the button
      checkboxes.forEach(checkbox => {
        if (!ids.includes(checkbox.id)) {
          ids.push(checkbox.id)
        }
      });
    } else {
      document.getElementById('export').disabled = true; // disable the button
      ids = []
    };
    // console.log(ids);
  });
};

if (checkboxes) {
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('click', function handleClick(event) {
      if (checkbox.checked) {
        count++;
        if (!ids.includes(checkbox.id)) {
          document.getElementById("export").disabled = false; // enable the button
          ids.push(checkbox.id);
        }
      } else {
        count--;
        if (ids.includes(checkbox.id)) {
          console.log(checkbox.id);
          const index = ids.indexOf(checkbox.id);
          if (index > -1) {
            ids.splice(index, 1); // 2nd parameter means remove one item only
          }
        }
      }
      // All checkboxes are checked
      if (count === 0) {
        document.getElementById("export").disabled = true; // disable the button
        checkAll.checked = false;
        ids = [];
        // All checkboxes are not checked
      } else if (count === checkboxes.length) {
        checkAll.checked = true;
      }
    });
  });
}

function exportData() {
  console.log(ids);
  $.post("/results/store",
    {
      value: ids
    },
    function (data, status) {
      alert('value stored');
    });
}

/* Cover spinner */
const launchButton = document.getElementById('launchScript');
if (launchButton) {
  launchButton.addEventListener('click', event => {
    $('#cover-spin').show(0)
  });
};

const deleteButton = document.getElementById('deleteFile');
if (deleteButton) {
  deleteButton.addEventListener('click', event => {
    $('#cover-spin').show(0)
  });
};

const addButton = document.getElementById('addFile');
if (addButton) {
  addButton.addEventListener('click', event => {
    $('#cover-spin').show(0)
  });
};

const saveParamsButton = document.getElementById('saveParams');
if (saveParamsButton) {
  saveParamsButton.addEventListener('click', event => {
    $('#cover-spin').show(0)
  });
};

const database = document.getElementById('database');
if (database) {
  database.addEventListener('click', event => {
    $('#cover-spin').show(0)
  });
};


/* Expand, collapse */
$('.toggle-btn').click(function () {
  $('#objectCollapse').collapse('toggle');
  $(this).toggleClass('active')
});

/* 
 * When document is ready
 */
$(document).ready(function () {
  $('.toast').toast('show');
  $('.alert').alert();
  $('#objectCollapse').collapse('toggle');
  $('.toggle-btn').toggleClass('active')

  /* Datatables */
  $('.bioinfoRunsTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollY: "500px",
    scrollCollapse: true,
    language: {
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    }
  });

  $('.extractionsTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollX: true,
    scrollY: "500px",
    scrollCollapse: true,
    language: {
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    }
  });

  $('.medicalFilesTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollX: true,
    scrollY: "500px",
    scrollCollapse: true,
    language: {
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    }
  });

  $('.nextcladeTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollY: "500px",
    scrollX: true,
    scrollCollapse: true,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'colvis',
        postfixButtons: ['colvisRestore'],
        collectionLayout: 'fixed columns',
        collectionTitle: 'Colonnes affichées'
      }
    ],
    language: {
      buttons: {
        colvis: 'Sélectionner des colonnes',
        colvisRestore: '>> REMETTRE DEFAUT <<'
      },
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    },
    columnDefs: [
      {
        targets: [15, 16, 20, 26, 27, 29, 31],
        visible: false
      }
    ]
  });

  $('.pangolinTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollY: "500px",
    scrollX: true,
    scrollCollapse: true,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'colvis',
        postfixButtons: ['colvisRestore'],
        collectionLayout: 'fixed columns',
        collectionTitle: 'Colonnes affichées'
      }
    ],
    language: {
      buttons: {
        colvis: 'Sélectionner des colonnes',
        colvisRestore: '>> REMETTRE DEFAUT <<'
      },
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    },
    columnDefs: [
      {
        targets: [8, 16],
        visible: false
      }
    ]
  });

  $('.patientsTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    // scrollX: true,
    scrollY: "500px",
    scrollCollapse: true,
    language: {
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    }
  });

  $('.samplerLabTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollY: "500px",
    scrollCollapse: true,
    language: {
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    }
  });

  $('.samplesTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollY: "500px",
    scrollCollapse: true,
    language: {
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    }
  });

  $('.samplesheetsTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollX: true,
    scrollY: "500px",
    scrollCollapse: true,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'colvis',
        postfixButtons: ['colvisRestore'],
        collectionLayout: 'fixed columns',
        collectionTitle: 'Colonnes affichées'
      }
    ],
    language: {
      buttons: {
        colvis: 'Sélectionner des colonnes',
        colvisRestore: '>> REMETTRE DEFAUT <<'
      },
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    },
    columnDefs: [
      {
        targets: [],
        visible: false
      }
    ]
  });

  $('.senderLabTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollY: "500px",
    scrollCollapse: true,
    language: {
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    }
  });

  $('.summaryTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollY: "500px",
    scrollX: true,
    scrollCollapse: true,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'colvis',
        postfixButtons: ['colvisRestore'],
        collectionLayout: 'fixed columns',
        collectionTitle: 'Colonnes affichées'
      }
    ],
    language: {
      buttons: {
        colvis: 'Sélectionner des colonnes',
        colvisRestore: '>> REMETTRE DEFAUT <<'
      },
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    },
    columnDefs: [
      {
        targets: [],
        visible: false
      }
    ]
  });

  $('.validationTable').DataTable({
    paging: false,
    info: false,
    order: [[0, "asc"]],
    scrollY: "500px",
    scrollX: true,
    scrollCollapse: true,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'colvis',
        postfixButtons: ['colvisRestore'],
        collectionLayout: 'fixed columns',
        collectionTitle: 'Colonnes affichées'
      }
    ],
    language: {
      buttons: {
        colvis: 'Sélectionner des colonnes',
        colvisRestore: '>> REMETTRE DEFAUT <<'
      },
      lengthMenu: "Afficher _MENU_ lignes",
      zeroRecords: "Aucun résultat",
      info: "Affiche les pages _PAGE_ of _PAGES_",
      infoEmpty: "Aucun résultat disponible",
    },
    columnDefs: [
      {
        targets: [11, 12, 13, 14, 15, 16, 17, 18, 21],
        visible: false
      }
    ]
  });
});
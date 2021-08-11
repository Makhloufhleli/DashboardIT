var $collectionSites;
var $collectionDatabases;
var $collectionBackups;

var $buttonAddNewSite = $('<a href="#" class="badge badge-info btn f-right mt-2"><i class="fa fa-plus" ></i></a>');
var $buttonAddNewDatabase = $('<a href="#" class="badge badge-info btn f-right mt-2"><i class="fa fa-plus" ></i></a>');
var $buttonAddNewBackup = $('<a href="#" class="badge badge-info btn f-right mt-2"><i class="fa fa-plus" ></i></a>');

$(document).ready(function () {
    $collectionSites = $('#site_list');
    $collectionDatabases = $('#database_list');
    $collectionBackups = $('#backup_list');
    
    $collectionSites.append($buttonAddNewSite);
    $collectionDatabases.append($buttonAddNewDatabase);
    $collectionBackups.append($buttonAddNewBackup);
    
    $collectionSites.data('index', $collectionSites.find('#inputsites').length)
    $collectionDatabases.data('index', $collectionDatabases.find('#inputdatabases').length)
    $collectionBackups.data('index', $collectionBackups.find('#inputbackups').length)
    
    $collectionSites.find('#inputsites').each(function () {
        addRemoveSiteButton($(this));
    });
    $collectionDatabases.find('#inputdatabases').each(function () {
        addRemoveDatabaseButton($(this));
    });
    $collectionBackups.find('#inputbackups').each(function () {
        addRemoveBackupButton($(this));
    });
    
    $buttonAddNewSite.click(function (e) {
        e.preventDefault();
        addSitesNewForm();
    })
    $buttonAddNewDatabase.click(function (e) {
        e.preventDefault();
        addDatabasesNewForm();
    })
    $buttonAddNewBackup.click(function (e) {
        e.preventDefault();
        addBackupsNewForm();
    })
    
    console.log($('.col col-lg-2'))
    
    
});
function addSitesNewForm() {
    var prototype = $collectionSites.data('prototype');
    var index = $collectionSites.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionSites.data('index', index+1);
    var $rowSites = $('<div id="inputsites" class="row"></div>');
    var $colForm = $('<div class="col col-lg-10 mt-2"></div>').append(newForm);
    $rowSites.append($colForm);
    addRemoveSiteButton($rowSites);
    $buttonAddNewSite.before($rowSites);
}
function addDatabasesNewForm() {
    var prototype = $collectionDatabases.data('prototype');
    var index = $collectionDatabases.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionDatabases.data('index', index+1);
    var $rowDatabases = $('<div id="inputdatabases" class="row"></div>');
    var $colForm = $('<div class="col col-lg-10 mt-2"></div>').append(newForm);
    $rowDatabases.append($colForm);
    addRemoveDatabaseButton($rowDatabases);
    $buttonAddNewDatabase.before($rowDatabases);
}
function addBackupsNewForm() {
    var prototype = $collectionBackups.data('prototype');
    var index = $collectionBackups.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionBackups.data('index', index+1);
    var $rowBackups = $('<div id="inputbackups" class="row"></div>');
    var $colForm = $('<div class="col col-lg-10 mt-2"></div>').append(newForm);
    $rowBackups.append($colForm);
    addRemoveBackupButton($rowBackups);
    $buttonAddNewBackup.before($rowBackups);
}


function addRemoveSiteButton ($rowSites) {
    var $removeSiteButton = $('<a href="#" class="badge badge-danger btn mt-4"><i class="fa fa-trash"></i></a>');
    var $colRemouveSiteButton = $('<div class="col col-lg-2"></div>').append($removeSiteButton);
    $removeSiteButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('#inputsites').slideUp(1000, function () {
            $(this).remove();
        })
    });
    $rowSites.append($colRemouveSiteButton);
}
function addRemoveDatabaseButton ($rowDatabases) {
    var $removeDatabaseButton = $('<a href="#" class="badge badge-danger btn mt-4"><i class="fa fa-trash"></i></a>');
    var $colRemouveDatabaseButton = $('<div class="col col-lg-2"></div>').append($removeDatabaseButton);
    $removeDatabaseButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('#inputdatabases').slideUp(1000, function () {
            $(this).remove();
        })
    });
    $rowDatabases.append($colRemouveDatabaseButton);
}
function addRemoveBackupButton ($rowBackups) {
    var $removeBackupButton = $('<a href="#" class="badge badge-danger btn mt-4"><i class="fa fa-trash"></i></a>');
    var $colRemouveBackupButton = $('<div class="col col-lg-2"></div>').append($removeBackupButton);
    $removeBackupButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('#inputbackups').slideUp(1000, function () {
            $(this).remove();
        })
    });
    $rowBackups.append($colRemouveBackupButton);
}

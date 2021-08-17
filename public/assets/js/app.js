var $collectionSites;
var $collectionDatabases;
var $collectionBackups;

var $addNewSite = $('<a href="#" class="badge badge-info btn f-right mt-2"><i class="fa fa-plus" ></i></a>');
var $addNewDatabase = $('<a href="#" class="badge badge-info btn f-right mt-2"><i class="fa fa-plus" ></i></a>');
var $addNewBackup = $('<a href="#" class="badge badge-info btn f-right mt-2"><i class="fa fa-plus" ></i></a>');

$(document).ready(function () {
    $collectionSites = $('#site_list');
    $collectionDatabases = $('#database_list');
    $collectionBackups = $('#backup_list');
    
    $collectionSites.append($addNewSite);
    $collectionDatabases.append($addNewDatabase);
    $collectionBackups.append($addNewBackup);
    
    $collectionSites.data('index', $collectionSites.find('.panel').length);
    $collectionSites.find('.panel').each(function () {
        addRemoveSiteButton($(this));
    });
    
    $collectionDatabases.data('index', $collectionDatabases.find('.panel').length);
    $collectionDatabases.find('.panel').each(function () {
        addRemoveDatabaseButton($(this));
    });
    
    $collectionBackups.data('index', $collectionBackups.find('.panel').length);
    $collectionBackups.find('.panel').each(function () {
        addRemoveBackupButton($(this));
    });
    
    $addNewSite.click(function (e) {
        e.preventDefault();
        addNewSiteForm();
    });
    $addNewDatabase.click(function (e) {
        e.preventDefault();
        addNewDatabaseForm();
    });
    $addNewBackup.click(function (e) {
        e.preventDefault();
        addNewBackupForm();
    });
    
});
function addNewSiteForm() {
    var prototype = $collectionSites.data('prototype');
    var index = $collectionSites.data('index');
    var newSiteForm = prototype;
    newSiteForm = newSiteForm.replace(/__name__/g, index);
    $collectionSites.data('index', index+1);
    var $panel = $('<div class="panel col-lg-12"></div>');
    var $panelBody = $('<div class="panel-body"></div>').append(newSiteForm);
    $panel.append($panelBody);
    addRemoveSiteButton($panel);
    $addNewSite.before($panel);
}

function addNewDatabaseForm() {
    var prototype = $collectionDatabases.data('prototype');
    var index = $collectionDatabases.data('index');
    var newDatabaseForm = prototype;
    newDatabaseForm = newDatabaseForm.replace(/__name__/g, index);
    $collectionDatabases.data('index', index+1);
    var $panel = $('<div class="panel panel-primary col-lg-12"><div class="panel-heading"></div></div>');
    var $panelBody = $('<div class="panel-body"></div>').append(newDatabaseForm);
    $panel.append($panelBody);
    addRemoveDatabaseButton($panel);
    $addNewDatabase.before($panel);
}

function addNewBackupForm() {
    var prototype = $collectionBackups.data('prototype');
    var index = $collectionBackups.data('index');
    var newBackupForm = prototype;
    newBackupForm = newBackupForm.replace(/__name__/g, index);
    $collectionBackups.data('index', index+1);
    var $panel = $('<div class="panel panel-primary col-lg-12"><div class="panel-heading"></div></div>');
    var $panelBody = $('<div class="panel-body"></div>').append(newBackupForm);
    $panel.append($panelBody);
    addRemoveBackupButton($panel);
    $addNewBackup.before($panel);
}


function addRemoveSiteButton ($panel) {
    var $removeSiteButton = $('<a href="#" class="badge badge-danger btn mt-2 f-right"><i class="fa fa-trash"></i></a>');
    var $panelFooter = $('<div class="panel-body"></div>').append($removeSiteButton);
    $removeSiteButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('.panel').slideUp(1000, function () {
            $(this).remove();
        })
    });
    $panel.append($panelFooter);
}

function addRemoveDatabaseButton ($panel) {
    var $removeDatabaseButton = $('<a href="#" class="badge badge-danger btn mt-2 f-right"><i class="fa fa-trash"></i></a>');
    var $panelFooter = $('<div class="panel-body"></div>').append($removeDatabaseButton);
    $removeDatabaseButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('.panel').slideUp(1000, function () {
            $(this).remove();
        })
    });
    $panel.append($panelFooter);
}

function addRemoveBackupButton ($panel) {
    var $removeBackupButton = $('<a href="#" class="badge badge-danger btn mt-2 f-right"><i class="fa fa-trash"></i></a>');
    var $panelFooter = $('<div class="panel-body"></div>').append($removeBackupButton);
    $removeBackupButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('.panel').slideUp(1000, function () {
            $(this).remove();
        })
    });
    $panel.append($panelFooter);
}

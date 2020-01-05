var app = app || {};

app.RestApiCall = Backbone.Model.extend({
    urlRoot: baseUrl + "index.php/ContactListController/contacts",
    id: 'myID',
});
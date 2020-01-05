var app = app || {};

app.SingleContact = Backbone.Model.extend({
    urlRoot: baseUrl + "index.php/ContactListController/contacts",
    idAttribute: 'contactId'
});
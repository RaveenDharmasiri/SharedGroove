var app = app || {};

app.ContactsCollection = Backbone.Collection.extend({
    model: app.SingleContact
});
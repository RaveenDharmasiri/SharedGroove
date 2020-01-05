var app = app || {};

// The view for all the flowers
app.AllContactsView = Backbone.View.extend({

    tagName: 'tbody',

    render: function() {
        this.model.each(this.addContact, this);
        return this;
    },

    addContact: function(contact) {
        var contactView = new app.SingleContactView({ model: contact });
        this.el.append(contactView.render().el);
    }

});
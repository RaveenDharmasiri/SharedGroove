var app = app || {};

// The view for a single model view, which is one flower
app.SingleContactView = Backbone.View.extend({

    tagName: "tr",

    events: {
        'click .btn-delete': "clicked",
    },
    clicked: function() {
        //console.log(this);
        // var catchID = (this.model.get('contactId'));
        $('#deleteContact').modal('show');
        userModel = this.model;

        // this.model.destroy( //  this is DELETE method.
        //     {
        //         contentType: 'application/json',
        //         data: JSON.stringify({ contactId: catchID }),
        //         success: function(response) {
        //             // console.log(contactGroup);
        //             // populateView();
        //             // contactGroup.remove(this.model);
        //             console.log('This is the response' + response);
        //             console.log(contactList);
        //         },
        //         error: function(err) {
        //             console.log(contactGroup);
        //             populateView();
        //             console.log('Failed to delete contact!');
        //         }
        //     });
    },

    render: function() {
        template = _.template($("#contactElement").html())
        var contactTemplate = template(this.model.toJSON());
        console.log(this.model.toJSON());
        $(this.el).html(contactTemplate);
        return this;
    }
});
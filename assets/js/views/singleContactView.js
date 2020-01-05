var app = app || {};

// The view for a single model view, which is one flower
app.SingleContactView = Backbone.View.extend({

    tagName: "tr",

    render: function() {
        template = _.template($("#contactElement").html())
        var contactTemplate = template(this.model.toJSON());
        console.log(this.model.toJSON());
        $(this.el).html(contactTemplate);
        return this;
    }
});
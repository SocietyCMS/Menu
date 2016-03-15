var $tree = $('#tree1');

$tree.tree({
    autoOpen: true,
    dragAndDrop: true,
    onCanMove: function (node) {
        if (!node.parent.parent) {
            return false;
        }
        return true;
    },
    onCanMoveTo: function (moved_node, target_node, position) {
        if (!target_node.parent.parent && position != "inside") {
            return false;
        }
        return true;
    },
    onCanSelectNode: function (node) {
        if (!node.parent.parent) {
            return false;
        }
        return true;
    }
});

$tree.bind(
    'tree.select',
    function (event) {
        if (event.node) {
            var node = event.node;
            MenuVueApp.selectNode(node)
        }
        else {
            MenuVueApp.selectNode(null)
        }
    }
).bind(
    'tree.move',
    function (event) {
        event.preventDefault();
        event.move_info.do_move();

        var data = {
            node:   event.move_info.moved_node.id,
            target: event.move_info.target_node.id,
            position: event.move_info.position,
            previous_parent:event.move_info.previous_parent.id
        };

        var resource = Vue.resource(societycms.api.menu.node.update);
        resource.update({node:data.node}, data).then(function (response) {
            toastr.success('Successfully saved', 'Success', {
                timeOut: 1000,
                preventDuplicates: true,
                progressBar: false
            });
        });
    }
);


var MenuVueApp = new Vue({
    el: '#societyAdmin',
    data: {
        menu: null,
        selectedNode: {
            id: null,
            name: null,
            url: null,
            active:null
        },
        newRoot: ""
    },
    ready() {
        this.reloadTree();
    },
    methods: {
        reloadTree() {
            var resource = this.$resource(societycms.api.menu.menu.index);
            resource.get(function (response) {
                this.menu = response.data;
                $tree.tree('loadData', this.menu);

                if(this.selectedNode) {
                    var node = $tree.tree('getNodeById', this.selectedNode.id);
                    $tree.tree('selectNode', node);
                }

            }.bind(this));
        },

        selectNode(node) {
            if(node == null) {
                return this.selectedNode = {
                    id: null,
                        name: null,
                        url: null,
                        active:null,
                        subject:null
                };
            }

            var resource = this.$resource(societycms.api.menu.node.show);
            resource.get({node:node.id},function (response) {
                this.selectedNode = response.data;

                if(this.selectedNode.useSubject) {
                    $('.ui.dropdown.item-subject').dropdown('set selected', this.selectedNode.subject);
                    $('.ui.dropdown.item-url').dropdown('clear');
                    $('.ui.accordion').accordion('open', 0);
                    $('.ui.accordion').accordion('close others');
                } else if(this.selectedNode.url) {
                    $('.ui.dropdown.item-subject').dropdown('clear');
                    $('.ui.dropdown.item-url').dropdown('set selected', this.selectedNode.url);
                    $('.ui.accordion').accordion('open', 1);
                    $('.ui.accordion').accordion('close others');
                } else {
                    $('.ui.dropdown.item-subject').dropdown('clear');
                    $('.ui.dropdown.item-url').dropdown('clear');
                }

            }.bind(this));
        },

        updateNode: function () {

            var resource = this.$resource(societycms.api.menu.node.update);
            resource.update({node:this.selectedNode.id}, this.selectedNode,function (response) {
                this.reloadTree();
            }.bind(this));
        },

        createRoot: function () {
            var resource = this.$resource(societycms.api.menu.menu.store);
            resource.save({name: this.newRoot},function (response) {
                this.reloadTree();
            }.bind(this));
            this.newRoot = "";
        },

        createLink: function () {
            var resource = this.$resource(societycms.api.menu.node.store);
            resource.save({},function (response) {
                this.selectedNode = response.data;
                this.reloadTree();
            }.bind(this));
        }
    }
});

$('#createLinkModal')
    .modal('attach events', '#createLink', 'show');

$('#createMenuModal')
    .modal('attach events', '#createMenu', 'show');

setTimeout(function() {
    $('.ui.accordion').accordion().first().accordion({
        onOpen: function (e) {
            MenuVueApp.selectedNode.useSubject = $(this).data().usesubject;
        }
    });

    $('.ui.dropdown.item-subject')
        .dropdown({
            onChange: function(value, text, $selectedItem) {
                MenuVueApp.selectedNode.subject = value;
                MenuVueApp.updateNode();
            }
        });
    $('.ui.dropdown.item-url')
        .dropdown({
            onChange: function(value, text, $selectedItem) {
                MenuVueApp.selectedNode.url = value;
                MenuVueApp.updateNode();
            },
            allowAdditions: true
        })
    ;
}, 200);

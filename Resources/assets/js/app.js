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
        selectedNode: null
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
                return this.selectedNode = null;
            }

            var resource = this.$resource(societycms.api.menu.node.show);
            resource.get({node:node.id},function (response) {
                this.selectedNode = response.data;

                if(this.selectedNode.useSubject) {
                    $('.ui.accordion').accordion('open', 0);
                    $('.ui.accordion').accordion('close others');


                } else {
                    $('.ui.accordion').accordion('open', 1);
                    $('.ui.accordion').accordion('close others');
                }

            }.bind(this));
        },

        updateNode: function () {

            var resource = this.$resource(societycms.api.menu.node.update);
            resource.update({node:this.selectedNode.id}, this.selectedNode,function (response) {
                this.reloadTree();
            }.bind(this));

        }
    }
});


setTimeout(function() {
    $('.ui.accordion').accordion().first().accordion({
        onOpen: function (e) {
            MenuVueApp.selectedNode.useSubject = $(this).data().usesubject;
        }
    });
}, 200);

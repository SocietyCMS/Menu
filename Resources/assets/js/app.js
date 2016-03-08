$('#tree1').tree({
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

$('#tree1').bind(
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
        var resource = Vue.resource('/api/menu/menu');
        resource.save({tree: $(this).tree('toJson')}).then(function (response) {
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
            var resource = this.$resource('/api/menu/menu');
            resource.get(function (response) {
                this.menu = response.data;
                $('#tree1').tree('loadData', this.menu);
            }.bind(this));
        },

        selectNode(node) {
            var resource = this.$resource('/api/menu/menu/:id');
            resource.get({id:node.id},function (response) {
                this.selectedNode = response.data;
            }.bind(this));
        },

        updateNode: function () {

            var resource = this.$resource('/api/menu/menu/:id');
            resource.update({id:this.selectedNode.id}, this.selectedNode,function (response) {
                this.reloadTree();
            }.bind(this));

            console.log(this.selectedNode);
            console.log(this.menu);
        },
    }
});
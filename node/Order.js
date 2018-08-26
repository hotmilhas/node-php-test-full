const Order = (() => {
    const fs = require('fs');

    this.save = (order) => {
        let orders = require('../orders.json');
        order.id = orders.length ? orders.length + 1 : 1;
        orders.push(order);
        fs.writeFile('../orders.json', JSON.stringify(orders), { flag: 'w'});
        return order;
    };

    this.getAll = () => {
        return require('../orders.json');
    };

    return {
        save : this.save,
        getAll : this.getAll
    }
})();



module.exports = Order;


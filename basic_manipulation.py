import mysql.connector

mydb = mysql.connector.connect(
    host="localhost",
    user="order_product",
    password="password",
    database="transactions"
)

mycursor = mydb.cursor()


# This command finds the order that requires minimum number of products to fulfil itself
min_order_command = "SELECT id, no_products FROM ORDERS o WHERE o.no_products IN (SELECT MIN(no_products) FROM orders);"

mycursor.execute(min_order_command)

myresult = mycursor.fetchone()

min_order_productid = "SELECT order_id, product_id, quantity FROM order_items WHERE order_items.order_id = {}".format(myresult[0])

print("Order Number {} has the minimum number of products required which is {}".format(myresult[0], myresult[1]))

mycursor.execute(min_order_productid)

myresult1 = mycursor.fetchall()

for x in myresult1: 
    print("This order requires product number {} and the quantity required is {}".format(x[1], x[2]))
    order_id = x[0]
    product_id = x[1]
    quantity = x[2]

# UPDATE Commands for the algorithm

# Updating order_items - Take the product_id check all elements in column product_id and make the quantity of it to 0 
command1 = "UPDATE order_items SET quantity = 9999 WHERE product_id = {}".format(product_id)
mycursor.execute(command1)

# Updating orders - Check if quantity of any order_id is 0 then decrement no_products in orders table

command2 = "SELECT order_id, product_id FROM order_items WHERE quantity = 9999"
mycursor.execute(command2)
myresult2 = mycursor.fetchall()
for x in myresult2:
    print("Order to update {}".format(x[0]))
    order_id = x[0]
    product_id = x[1]
    if()
    command3 = "UPDATE orders SET no_products = (no_products - 1)  WHERE id = {}".format(order_id)
    mycursor.execute(command3)
    print("Products to update {}".format(product_id))
    command4 = "UPDATE products SET total_quantity = 0 , order_quantity = 0 WHERE id = {}".format(product_id)
    mycursor.execute(command4)

# Updating products - Check if quantity is 0 for any product_id then decrement order_quantity by one and total_quantity by previous quantity






# Exit Condition - no_products is 999 for each id in orders 


mydb.commit()
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

min_order_productid = "SELECT product_id, quantity FROM order_items WHERE order_items.order_id = {}".format(myresult[0])

print("Order Number {} has the minimum number of products required which is {}".format(myresult[0], myresult[1]))

mycursor.execute(min_order_productid)

myresult1 = mycursor.fetchall()

for x in myresult1: 
    print("This order requires product number {} and the quantity required is {}".format(x[0], x[1]))
    #product_id = x[0]
    #quantity = x[1]

# UPDATE Commands for the algorithm

# Updating order_items - Take the product_id check all elements in column product_id and make the quantity of it to 0 
#command1 = "UPDATE order_items SET quantity = 0 WHERE product_id = {}".format(product_id)

# Updating orders - Check if quantity of any order_id is 0 then decrement no_products in orders table

# Updating products - Check if quantity is 0 for any product_id then decrement order_quantity by one and total_quantity by previous quantity

# Exit Condition - no_products is 999 for each id in orders 

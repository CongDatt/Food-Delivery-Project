- DB Design: https://app.diagrams.net/?src=about#G1RmkZ3BBoVjoH041qBu9tEVPwBFOaFQY6

- Noti Flow

# Notification

## step 1: user create order and notify

- to Merchant
    - title: New order
    - message:  You have a new order form {user phone} at {time created at of order} .

## Step 2: merchant confirm take order (status = 1)

- to User
    - title: Order Preparing
    - message:  Your order {order Id} is preparing
- to Shipper
    - title: New Order
    - message: New order is preparing

## Step 3: shipper take order (status = 2)

- to Merchant
    - title:  Order Delivering
    - message: Order {orderId} is being delivered
- to User
    - title: Order Delivering
    - message: Order {orderId} is being delivered

## Step 4: Shipper confirm delivered (status = 3)

- to Merchant
    - title: Order Delivered
    - message: Shipper have  delivered  order {orderId}
- to User
    - title: Order Delivered
    - message: Shipper have  delivered  order {orderId}
    

## Step 5: User confirm received (status = 4)

- to Shipper
    - title: Order Delivered
    - message: User have  received  order {orderId}
- to Merchant
    - title: Order Delivered
    - message: User have  received  order {orderId}


- Docs: https://docs.google.com/document/d/1FDctaou4HsNCxx6VmQ60ejHZqb-AIsVDzMdQohfCPVU/edit

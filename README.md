# Online Book Store - A Mini Project in Laravel

This is a simple shopping cart project based on PHP Laravel, demonstrating online purchase of books. Book Publishing companies can sell their books to their customers through this medium. Following are the types of users engaged with the application. 
1. Book buyers(customers/readers)
2. Publishers
3. Administrators
   
## The Process
The publishers can add their new books to the store. On approval from Administrator for that book, publishers can make request for stock for the same. Once the administrator approves the stock request, the books are available in the store for purchase by customers. Publishers can view the sale status of their books and make further stock requests if necessary.     

Customers(Book buyers) can browse for books of different catagories, languages etc. and add add them to their book cart on Signing-In. Order can be placed after review of order summary. Stock availability is strictly checked in each stage before the order placement. Administrators can update the status of each order to packed/shipped/delivered. 

#### Some Exclusions
1. User Registration (fake user data is seeded)
2. Payment Integration 

## Technolgies 
Laravel 11, MySQL, Bootstrap 5

## Sample user data for testing
### Emails 
#### Customers (Book buyers)
- graham.minnie<span>@</span>example.org
- prohaska.leone<span>@</span>example.net
- desmond78<span>@</span>example.net
- clark.breitenberg<span>@</span>example.net

#### Publishers
- sbotsford<span>@</span>example.net
- gflatley<span>@</span>example.com
- hschroeder<span>@</span>example.net
- michaela.murray<span>@</span>example.org
#### Administrator
- mhickle<span>@</span>example.org

### Password is same for all users  - 'password' 
## Some screenshots
### Customer Login
![reader-cart](https://github.com/vinod-ayckattu/onlinebookstore/assets/151558463/1b6e2a82-d8a4-486e-9508-cbef9fbc570f)
![reader-review](https://github.com/vinod-ayckattu/onlinebookstore/assets/151558463/a68cf5f8-4ca7-4b0e-9a5d-50e99d507301)
![reader-order](https://github.com/vinod-ayckattu/onlinebookstore/assets/151558463/cf7921ca-cf24-4a25-95e5-6987995249f5)

### Publisher Login 
![pub-main](https://github.com/vinod-ayckattu/onlinebookstore/assets/151558463/6d1a8c2c-83c4-4b67-ab24-3b15281be2b4)
![pub-new-book](https://github.com/vinod-ayckattu/onlinebookstore/assets/151558463/f2637ec2-b8dc-44f6-8c03-cce6ab9fd356)

### Administrator Login

![admin-main](https://github.com/vinod-ayckattu/onlinebookstore/assets/151558463/d32b06a1-5e52-4487-b75c-9b2c797a0a84)
![admin-order](https://github.com/vinod-ayckattu/onlinebookstore/assets/151558463/f3b78bde-9a91-4b1e-bc02-9d9f0d9863d1)

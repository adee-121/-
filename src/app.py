from app import db, Product

# إدخال بيانات مبدئية
def seed_data():
    # تحقق إذا كانت المنتجات موجودة بالفعل
    if Product.query.first():
        print("Data already seeded!")
        return
    
    product1 = Product(name="Laptop", description="High-performance laptop", price=1500.0, stock=10, image_url="https://via.placeholder.com/150")
    product2 = Product(name="Smartphone", description="Latest model smartphone", price=999.99, stock=20, image_url="https://via.placeholder.com/150")
    product3 = Product(name="Headphones", description="Noise-cancelling headphones", price=199.99, stock=15, image_url="https://via.placeholder.com/150")

    db.session.add_all([product1, product2, product3])
    db.session.commit()

    print("Products seeded successfully!")

seed_data()

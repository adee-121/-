from flask import Flask
from src.routes import register_routes

def create_app():
    app = Flask(__name__)
    app.config.from_object('config.Config')

    # تسجيل المسارات
    register_routes(app)

    return app

if __name__ == "__main__":
    app = create_app()
    app.run(debug=True)

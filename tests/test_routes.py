import pytest
from src.app import create_app

@pytest.fixture
def app():
    app = create_app()
    app.config['TESTING'] = True
    return app

@pytest.fixture
def client(app):
    return app.test_client()

def test_home_route(client):
    response = client.get("/")
    assert response.status_code == 200
    assert b"Welcome to the Home Page" in response.data

def test_about_route(client):
    response = client.get("/about")
    assert response.status_code == 200
    assert b"This is the about page" in response.data

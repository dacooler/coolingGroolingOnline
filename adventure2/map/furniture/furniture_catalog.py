import json
from typing import Any

from furniture_blueprints import FurnitureBlueprint


class FurnitureCatalog:
    _catalog: dict[str, FurnitureBlueprint] | None = None

    @staticmethod
    def get_blueprint(name: str):
        if FurnitureCatalog._catalog is None:
            FurnitureCatalog.load_catalog()
            assert FurnitureCatalog._catalog is not None, 'Furniture catalog should not be None after load has been called.'

        return FurnitureCatalog._catalog[name]

    @staticmethod
    def load_catalog():
        with open('src/furniture.json') as file:
            json_data: list[dict[str, Any]] = json.loads(file.read())
            {furniture_data['type']: FurnitureBlueprint.from_json(furniture_data) for furniture_data in json_data}
        
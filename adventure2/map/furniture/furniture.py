from typing import Any

from .furniture_catalog import FurnitureCatalog
from ..coord import Coord
from .furniture_blueprints import FurnitureBlueprint
from ..height_difference import HeightDifference
from ..sized_part import SizedPart


class Furniture:
    blueprint: FurnitureBlueprint
    position: Coord

    @property
    def height_difference(self):
        return HeightDifference(
            self.position,
            self.blueprint.height_difference_size,
        )

    @property
    def part(self):
        return SizedPart(
            self.position,
            self.blueprint.size,
            self.blueprint.css_classes,
        )

    @property
    def has_collision(self):
        return self.blueprint.has_collision
    
    def __init__(self, blueprint: FurnitureBlueprint, position: Coord):
        self.blueprint = blueprint
        self.position = position

    @staticmethod
    def from_json(json: dict[str, Any]):
        blueprint = FurnitureCatalog.get_blueprint(json['furniture_type'])
        position = Coord.from_json(json['position'])
        return Furniture(blueprint, position)

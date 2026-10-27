from typing import Any

from .wall_opening_type import WallOpeningType


class WallOpening:
    DOOR_HEIGHT = WINDOW_TOP_HEIGHT = 100  # must be 100 since the pole css class moves up wall openings by exactly 100px
    WINDOW_BOTTOM_HEIGHT = 40
    position: float
    width: float
    type: WallOpeningType

    def __init__(self, position: float, width: float, type: WallOpeningType):
        self.position = position
        self.width = width
        self.type = type

    @staticmethod
    def from_json(json: dict[str, Any]):
        return WallOpening(
            json['position'],
            json['width'],
            WallOpeningType.DOOR if json['type'] == 'door' else WallOpeningType.WINDOW 
        )

    def __lt__(self, other: 'WallOpening'):
        return self.position < other.position

    def __str__(self):
        return f'Door(position={self.position}, width={self.width})'

    def __repr__(self):
        return str(self)

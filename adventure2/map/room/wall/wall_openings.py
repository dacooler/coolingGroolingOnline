from typing import Any

from .wall_opening import WallOpening


class WallOpenings:
    """Represents the 4 (or more) doors of a normal house. (yes, a normal house has 4 (or more) doors (or less))."""
    _wall_openings: list[list[WallOpening]]

    def __init__(self):
        self._wall_openings = [[], [], [], []]

    def get_openings_of_wall(self, wall_index: int):
        return self._wall_openings[wall_index]

    @staticmethod
    def from_json(json: list[dict[str, Any]]):
        wall_openings = WallOpenings()
        for wall_opening_json in json:
            wall_opening = WallOpening.from_json(wall_opening_json)
            wall_openings._wall_openings[int(wall_opening_json['wall_index'])].append(wall_opening)

        return wall_openings

    def __str__(self):
        return f'Doors({str(self._wall_openings)})'

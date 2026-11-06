import json
from types import SimpleNamespace
from typing import Any, Callable
from typing import Literal


class Position:
    x: float
    y: float

    def __init__(self, x: float, y: float):
        self.x = x
        self.y = y


class Size:
    width: float
    height: float
    depth: float


Direction = Literal["south"] | Literal["west"] | Literal["north"] | Literal["east"]


class Wall:
    direction: Direction
    args: list[str]


class WallOpening:
    type: Literal["door"] | Literal["window"]
    wall_index: Literal[0] | Literal[1] | Literal[2] | Literal[3]
    position: float
    width: float


class Furniture:
    type: Literal['furniture']
    furniture_type: str
    position: Position
    rotation: float
    children: None | list["Furniture"]

    def __init__(self, furniture_type: str, position: Position, rotation: float, children: list["Furniture"] | None = None):
        self.type = "furniture"
        self.furniture_type = furniture_type
        self.position = position
        self.rotation = rotation

        if children:
            self.children = children



class RoomData:
    type: str
    position: Position
    size: Size
    css_classes: list[str]
    walls: list[Wall]
    wall_openings: list[WallOpening]
    children: list[Furniture]


file_name = 'src/rooms/room.json'


def load() -> RoomData:
    with open(file_name, 'r') as file:
        text = file.read()
        
    return json.loads(text, object_hook=SimpleNamespace)


def save(json_data: dict[str, Any]):
    text = json.dumps(json_data, default=lambda obj: vars(obj), indent=4)

    with open(file_name, 'w') as file:
        file.write(text)


def apply(func: Callable[[RoomData], None]):
    json_data = load()
    json_data = func(json_data)
    save(json_data)


def place_furniture():
    apply(_place_furniture)


def _place_furniture(json_data: RoomData):
    json_data.children.append(Furniture(
        "shelf",
        Position(100, 100),
        67,
    ))
    return json_data


if __name__ == '__main__':
    place_furniture()
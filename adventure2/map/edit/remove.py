from edit import apply, RoomData
import argparse

parser = argparse.ArgumentParser(
    prog="Remover",
    description="removes rooms haha"
)

parser.add_argument("id")

def remove_furniture(id: str):
    apply(lambda json: _remove_furniture(json, id))

def _remove_furniture(json_data: RoomData, id: str):
    new_children = []
    print("looking for")
    print(id)
    print("found:")
    for furniture in json_data.children:
        print(furniture.id)
        if furniture.id != id:
            new_children.append(furniture)
    json_data.children = new_children
    return json_data


if __name__ == '__main__':
    args = parser.parse_args()
    remove_furniture(args.id)

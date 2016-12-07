defmodule Aoc16.Day01 do

  def run do
    File.open! "inputs/01_input.txt", fn(pid) ->
      IO.read(pid, :all)
      |> String.trim
      |> process_text
    end
  end

  def process_text(text) do
    direction_list = String.replace(text, " ", "") |> String.split(",")

    process_list(direction_list, {0, 0}, "N", %{{0, 0} => 1})
  end

  def process_list([h | t], coordinates, direction, block_history) do
    {turn, blocks} = parse_instruction h
    new_direction = calculate_new_direction direction, turn
    new_coordinates = calculate_new_coordinates coordinates, new_direction, blocks
    new_block_history = check_block_location(block_history, coordinates, new_coordinates)

    process_list t, new_coordinates, new_direction, new_block_history
  end

  def process_list([], {x, y}, _, block_history) do
    {convert_coordinates_to_blocks({x, y}), Map.get(block_history, "answer", false)}
  end

  defp parse_instruction(instruction) do
    case instruction do
      "R" <> blocks ->
        {value, _} = Integer.parse(blocks)
        {"R", value}
      "L" <> blocks ->
        {value, _} = Integer.parse(blocks)
        {"L", value}
    end
  end

  defp calculate_new_direction(direction, turn) do
    case turn do
      "R" ->
        cond do
          direction == "N" -> "E"
          direction == "S" -> "W"
          direction == "E" -> "S"
          direction == "W" -> "N"
        end
      "L" ->
        cond do
          direction == "N" -> "W"
          direction == "S" -> "E"
          direction == "E" -> "N"
          direction == "W" -> "S"
        end
    end
  end

  defp calculate_new_coordinates({x, y}, direction, blocks) do
    case direction do
      "N" -> {x, y + blocks}
      "S" -> {x, y - blocks}
      "E" -> {x + blocks, y}
      "W" -> {x - blocks, y}
    end
  end

  defp check_block_location(block_history, {old_x, old_y}, {new_x, new_y}) do
    [_ | traveled_coordinates] = for x <- old_x..new_x, y <- old_y..new_y do
      {x, y}
    end

    if Map.get(block_history, "hasFound", false) == false do
      Enum.reduce(traveled_coordinates, block_history, fn({x, y}, acc) ->
        acc = put_in(acc, [{x, y}], Map.get(block_history, {x, y}, 0) + 1)
        if Map.get(acc, {x, y}, 0) == 2 do
          acc = put_in(acc, ["answer"], convert_coordinates_to_blocks {x, y})
          put_in(acc, ["hasFound"], true)
        else
          acc
        end
      end)
    else
      put_in(block_history, [{new_x, new_y}], Map.get(block_history, {new_x, new_y}, 0) + 1)
    end
  end

  defp convert_coordinates_to_blocks({x, y}) do
    x = if x < 0, do: x * -1, else: x
    y = if y < 0, do: y * -1, else: y
    x + y
  end
end
